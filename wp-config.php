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
define('DB_NAME', 'Wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'd/ /HrDCbVvyxUy/qTb9*52]]H=-hA !vPM>Rz=blYD6:E/|9;j&;hY*xGq5GF;3');
define('SECURE_AUTH_KEY',  'r(N1Er8 4I79pNKLk:kaV4(k[$c|Y]Q.xbjy)5ASLM_B>5zFv+^c,M2:U!n2p~$9');
define('LOGGED_IN_KEY',    ')ls@*K`6J7&^4GYRbey!6UHdZ!3/V)XO@cEvFldeq+^O^&_7-U0%HL is:.9B5k7');
define('NONCE_KEY',        '99+Nn++h4}Pl{^m@]Wn$cm1M,mS[W]Iqy4:E<.7P,ml.MSyPV<?[!0cxh[tsj]5}');
define('AUTH_SALT',        'k:5xzUw^~k*i5@6~/P=D*}JASCH8ZmxpiA-[GL}W|`*Dx/9oLipr`3eM~/Zgbv8O');
define('SECURE_AUTH_SALT', '!&>3+iOgA(VW>:plAB!-2iMK[D/Eyo~}(93?zTo:-j]T6:3zq!:G/sgRT;t-Fi|!');
define('LOGGED_IN_SALT',   'pto1C 8U5/q11WaC2?NzKGLb;GxeUw!z!f~75h`b:UB^j(~eYV]yB$-8&FPcB3]F');
define('NONCE_SALT',       '@/@2b[k]i&2jYJ5RT9|h>pq[qqD03`{|l5anXCa5y&MfkO**,#w/||#aSFwyj$Fz');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
