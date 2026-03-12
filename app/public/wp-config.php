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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'S,4NQ#ve[KmWqEN <yKb+aE|]U|iMBS.ZjRypGsDM>e71nzrBpn/^raZb}y?sFe)' );
define( 'SECURE_AUTH_KEY',   '].#R%Bn%<X^.}C9RV.JNG?Q^P=O::[eVt5%o SAFDlWa!FhhL=>KIk>M-d<RSfW<' );
define( 'LOGGED_IN_KEY',     '#G(IDz@xFzF?ZS/:YPzBL)j#_:mSGB)v]s@]R<-A>ye4o[_i?8D#{x|2x;*jWn:+' );
define( 'NONCE_KEY',         '2(s4&.ZMV/Rs#15TYx6d+)_G.QEcuo5,w8=#V!2hlaOE`yPWt(#_X5;@,w*Fo[c`' );
define( 'AUTH_SALT',         '[m6j@Sskxz [*!}ec#3,@}ltZ&9&8H81kB7O64]0p)1A)>2c@|0TeIt>0L.(qtzy' );
define( 'SECURE_AUTH_SALT',  'L f<w!fTy{UL@BPs-m%Z@_&|{cIS,OldMR`Q5Dk3GJd(Tz.LyweDYc3esp#-,0F-' );
define( 'LOGGED_IN_SALT',    'Vy[`#AX<j=[:o2y+qu|Fi 1 v33EyqwgG.>GqLW=uaLDm+CG0F3s^`({%g%jBKL*' );
define( 'NONCE_SALT',        'Fa,wRa|ZWyGLEAu=+Fpr4>m&l)Ns^`SMxUD|spkT/zu. &_kNVi)iWeWwFXBOrC?' );
define( 'WP_CACHE_KEY_SALT', '?:pb}{zXvn]zT&uZdS[3UwD&!^,sU=h-Ze5)hHkDA[>|<_@FgudnTg-iX?i476ma' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
// ============================================
// GOOGLE PLACES API — Avis clients
// Remplacer par vos vraies valeurs
// ============================================
// define( 'GOOGLE_PLACES_API_KEY', 'AIzaSy...' );
// define( 'GOOGLE_PLACE_ID',       'ChIJ...' );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
