<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'dkjgnegrj' );

/** MySQL database username */
define( 'DB_USER', 'lkrfld' );

/** MySQL database password */
define( 'DB_PASSWORD', 'df$%#$df#~' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'g#yd2Jh,YUr/D%$.m~_q 4Ia|ZZ^Lo{1~Lv.{tH(SEdzM:OPW41o8 /{$vZx|vX]' );
define( 'SECURE_AUTH_KEY',  'G~:q2<0PF522D%GQ?COqLeW9{ 5HMy3$OmEy ATeKjyY[20m7o4#J1?FHECMN7o!' );
define( 'LOGGED_IN_KEY',    '@73tQ{5@;t-dVj|r1gr`rv5>~_wVi&iGvzWw7^G2~hHnRHR`KK9#TeAEGeZC9H+;' );
define( 'NONCE_KEY',        'Um+`XybnKZ8qVV><}mL6omb!FN<jP4D9u4wHG9siTh,q8h(@pS|~w@$j~ksx8931' );
define( 'AUTH_SALT',        'D@>Zp4zc$w4a*7S0X$>`kYmwe-`NE}d.,no*O)?cn,~<eV4ap6]JY-ru@]N`lzP5' );
define( 'SECURE_AUTH_SALT', ';rF/zST{r7s/M2klR,8t*CzvMQ#mZDz__Xi^Lino0WK&b]gh;_/fs~z#J)8Vcu.:' );
define( 'LOGGED_IN_SALT',   '4beJ,PW.oKf-6r?Ok+{D1 Z-[q.Q;+.}rrP69[0#TD~-6?CiBVxnP&J7t4g55@^i' );
define( 'NONCE_SALT',       ']jEYPmc!T*:/W^?J;QMH$W7}47x(]XrP[>}Rf 5kch4Q_2dYSNbnt@62n%Sg8IpX' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'gtfo_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
