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
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'test2' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         '`w3(H[y-]HX{VN5cmTZRR4K.r-P<-(/Mu@HyC(,QT.UHhf3eZ#^F^%8KXw f:[]B' );
define( 'SECURE_AUTH_KEY',  'SHmf+_1sLm#9aJ3Ux{pnZ8GBpx{0lDmy#T<Z-:~3;ylV!SL^)[~,+8_ADG^GfS8G' );
define( 'LOGGED_IN_KEY',    'Ssd%j3YII%xj+GqimAG&ty>`s*E(Xx3B-Ik2_^C1 i=myBd^>Y)MXmO1m51E*gA1' );
define( 'NONCE_KEY',        '@n^F_]=. ek)PT6gz-?$KhH$>%66=m+X<[G]^:k7M)|o-#4]7{RLX@_f)bv3vhzt' );
define( 'AUTH_SALT',        ']LJDmO;Sm=> K`l%:IhZ}qp1SmTznk:8rdQc?C,QTI_nCHyd]&tC@?E}|FWTV%?T' );
define( 'SECURE_AUTH_SALT', '_#VL$beWX1O_21&AUWy*8#<yq#Xmf5ygh>yZaoAZRmm`C)M .=WrojkDKy|mE$z~' );
define( 'LOGGED_IN_SALT',   '4/!VnL_Zj;9^XG1P=CN6#gKS4+D*]l)lh% te.M; _]!R)U@Y_o*wZWT|X#Dm+y>' );
define( 'NONCE_SALT',       'aCjoe:tsUYI,`T}MX,C2_Jt45aFPH%?}0rqFW*)*L?t]Qes)@:dsW7n2Jqo1YOQ2' );

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
