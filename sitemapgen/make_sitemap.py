#!/usr/bin/env python3
import re
import sys
import datetime
from collections import deque
from urllib.parse import urljoin, urlparse, urldefrag

import requests
from bs4 import BeautifulSoup
from lxml import etree

START_URL = "https://free-flow.gr/"
ALLOWED_NETLOCS = {"free-flow.gr", "www.free-flow.gr"}

# Keep it conservative: skip obvious non-pages.
SKIP_EXTENSIONS = re.compile(r".*\.(jpg|jpeg|png|gif|webp|svg|pdf|zip|rar|7z|mp4|mov|avi|mp3|wav|css|js|woff2?|ttf|eot)$", re.I)

def normalize(url: str) -> str | None:
    if not url:
        return None
    url = url.strip()
    if url.startswith(("mailto:", "tel:", "javascript:")):
        return None

    # Resolve fragments (#...) away
    url, _frag = urldefrag(url)

    parsed = urlparse(url)
    if parsed.scheme not in ("http", "https"):
        return None

    if parsed.netloc not in ALLOWED_NETLOCS:
        return None

    # Optional: drop query strings to avoid duplicates
    url = parsed._replace(query="").geturl()

    if SKIP_EXTENSIONS.match(urlparse(url).path):
        return None

    return url

def fetch(url: str) -> str | None:
    try:
        r = requests.get(url, timeout=15, headers={"User-Agent": "SitemapGenerator/1.0 (+https://free-flow.gr/)"})
        if r.status_code != 200:
            return None
        ct = r.headers.get("Content-Type", "")
        if "text/html" not in ct:
            return None
        return r.text
    except Exception:
        return None

def crawl(start_url: str, max_pages: int = 5000) -> list[str]:
    seen = set()
    q = deque([start_url])

    while q and len(seen) < max_pages:
        url = q.popleft()
        url = normalize(url)
        if not url or url in seen:
            continue

        html = fetch(url)
        if html is None:
            continue

        seen.add(url)

        soup = BeautifulSoup(html, "html.parser")
        for a in soup.select("a[href]"):
            href = a.get("href")
            absolute = urljoin(url, href)
            n = normalize(absolute)
            if n and n not in seen:
                q.append(n)

    return sorted(seen)

def write_sitemap(urls: list[str], out_path: str = "sitemap.xml") -> None:
    NS = "http://www.sitemaps.org/schemas/sitemap/0.9"
    urlset = etree.Element("{%s}urlset" % NS, nsmap={None: NS})

    today = datetime.date.today().isoformat()

    for u in urls:
        url_el = etree.SubElement(urlset, "{%s}url" % NS)
        loc = etree.SubElement(url_el, "{%s}loc" % NS)
        loc.text = u

        # lastmod is optional, but helpful when accurate. Here we set "today" for everything you just updated.
        lastmod = etree.SubElement(url_el, "{%s}lastmod" % NS)
        lastmod.text = today

    tree = etree.ElementTree(urlset)
    tree.write(out_path, encoding="UTF-8", xml_declaration=True, pretty_print=True)

if __name__ == "__main__":
    start = START_URL if len(sys.argv) == 1 else sys.argv[1]
    urls = crawl(start_url=start)
    print(f"Found {len(urls)} URLs")
    write_sitemap(urls, "sitemap.xml")
    print("Wrote sitemap.xml")