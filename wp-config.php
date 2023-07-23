<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'YWb/,#?y`@H[#u(YZ+%^gi/$&oM3]*gvevy>8Pj3e((qbMZz_JquLJb4OR0o966a' );
define( 'SECURE_AUTH_KEY',  'aLs(<Q?^| Fubev7G<}m4^5a^7dU(oLP>>Y/.] WRD[@f06$S7B._INyUT,T:][V' );
define( 'LOGGED_IN_KEY',    'QRa#fo^Q{uW(as=rga.[Q_yZzB61up;C7I9,%A7Fh}k cF<e_<cp8R8]([R^g?!D' );
define( 'NONCE_KEY',        'i>xTfY@{.E-E&T ;xE=wELN{I&#[+1kksDzwfTkUY`C $?`L@Jg|KCS3Aok^Z:}V' );
define( 'AUTH_SALT',        'l;:+w<G>n]:O@(ihY+X/GuucGH@5Av{|XTHl^]_b{/r1 akhWKNZPL>1yE(|ZDH@' );
define( 'SECURE_AUTH_SALT', 'GC-L:!`I6i}IkSP:*(5q5AJ9&uMk4O3 v`4MdM!R`&m+xVK]S]MH3#S]4M?m^,]|' );
define( 'LOGGED_IN_SALT',   '2{!j:]mxTYAm_dww?N^naV_s@KEXbKQe*(mRFpOoP:~l`l4q`$-Q.4(n(3 :$I::' );
define( 'NONCE_SALT',       'sS$,.1?X_hGGoof2}xvl@C]/v|/WQ_>4)<q)wGE(b&A_bQ`OzhgdG<XhrfV3B0E)' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
