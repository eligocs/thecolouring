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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'thecolouring_blog' );

/** MySQL database username */
define( 'DB_USER', 'thecolouring_blog' );

/** MySQL database password */
define( 'DB_PASSWORD', '^jdJ[[W.z&i#' );

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
define( 'AUTH_KEY',         '.?F< ,C??xH.Xv{ThpmFwbgs:i~.-<7PFKbm]NKpgLKrblj 7,@})P4}}qQ6U!/.' );
define( 'SECURE_AUTH_KEY',  'a`H0ZS|J&;^jXv03Uk|tc&-=1sCV?o(M,JGE-+}M1C@+=N`%GbVV$$oD.yFmh7<d' );
define( 'LOGGED_IN_KEY',    'VS!6QF5}*3/+_yra&J}j2MgIG#>~81N(~R!{q9M4+3|ws`C~Cc#Ha]fRca(VTGL4' );
define( 'NONCE_KEY',        ';<UHjEqRM4)a+LRo_?([<?/=5ahE0+G2p8>o{s#(IsIU{x[vZL6Q(Bu ZOM5J;~j' );
define( 'AUTH_SALT',        '&l=AE!eoL2ZxU,?B<utpL#nsz3[o!z!q`U^1~w#m?a5T]Dr4S)EKpwl=`oZ]-F<C' );
define( 'SECURE_AUTH_SALT', '?g4{.x;$VjGfuC:l]ZzMLYX,@&<U@kNQJd$`};ZoBUbq!AG!^|p/W;*(5P#gZXss' );
define( 'LOGGED_IN_SALT',   'J]e|VYf>rbqSkmlrp;^1~(8z4w}ce$e-|8tuI06GC`PHbtk<b&N`AFXMM@,TWsLV' );
define( 'NONCE_SALT',       'eaPXA-x__X5wP^CGHAY<5#xdpj.}|xDra_4o`$ MI}7Lw]GshsbWlt%|{_Gh*4;T' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'tcl_';

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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
