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
define('DB_NAME', 'mdvd_armadio');

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
define('AUTH_KEY',         'Y2$nUEBlm&BT;`(M*:{-1|.oZSfB;_UK!A A|Y({nY`n#37f; =%|{v;aY!^<yl*');
define('SECURE_AUTH_KEY',  'n$!f[s((#2sS4)yaR[rG$O:r/ltQiG9j5%#jJO*mlx#oc(9ua6b%D1B..RyGd_A+');
define('LOGGED_IN_KEY',    '#$d(B}K~9ABVrP]0$^J]}Mv^})ke0C0Y(6[@]XWC?tkF 3ZQYW|WL0#]sZl{&VBF');
define('NONCE_KEY',        'kKO?Efj-X!Lg>m~Be6z4=EXms>{}nPg=i1,_W,g&h@ABGg&c-_Mmc|T2yqbu3eul');
define('AUTH_SALT',        ';{3V)CyHK`!t=-qgt%ffor]_2$(k}%/DCJI[gT@cZ5TrOc;`#.9 2F!Ktjg}q;8L');
define('SECURE_AUTH_SALT', 'r#k8S=4sCPQy4s.W/1w 33YhP0m0U25}:eqjPo{Bugc}8y:OOaP!uG6%Z%3ZR4L0');
define('LOGGED_IN_SALT',   ',+B.tfybp7yc+t#gI4(8x{.s`jPC;)~< y3[tb.pHcjN9ol[kE_s}k*!o[|guOPR');
define('NONCE_SALT',       '<7d$XKhW6*;M9#UXdUs8G+qUR^waR&!]pfiU)pG#qY!p[r@}D(OSWJU4R=%$8iC~');

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
