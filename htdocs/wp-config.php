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

/**
 * Database connection information is automatically provided.
 * There is no need to set or change the following database configuration
 * values:
 *   DB_HOST
 *   DB_NAME
 *   DB_USER
 *   DB_PASSWORD
 *   DB_CHARSET
 *   DB_COLLATE
 */

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */

define('AUTH_KEY',         '91K|34aouW,(<|YkS6d?GAeonhj]QN1ZU{B~rwEKQR5mzAY$-EYY}*]+su3q>uI9');
define('SECURE_AUTH_KEY',  'Txbh5JZhRfa#7;e5)2oGZ!M045.zS=Tv,;q9l2021qC9hTDafD?3GD1T%YuZ64T6');
define('LOGGED_IN_KEY',    'AU|qE;<ZY<M7+iYuq,3Zereu]BX?;b$ZAm1<=H=~=pJYxGT8oc5E5SV<z{Cqy6Ku');
define('NONCE_KEY',        '=(f1Dh*6fiUziIH-FY9+i[<][j~YopgDx!fQiK|BJcT#gll(B*?au{Nw^*2ZKd7V');
define('AUTH_SALT',        '8*g?V#J:;Ckz3kwo9u+t*hvar?0bNIVN2Q9G#i{N6?3v>4hkEl{}o4:6}RUE(JR2');
define('SECURE_AUTH_SALT', '#o?y9RAC8IrdOw:u#t^ZE%p{;sC*^+fa>i~-jNy%wfL;j1nR_?4wif)A)8K0m0wX');
define('LOGGED_IN_SALT',   'iuP.2KF|(]AO~_Usob,<_vF!Fztu76~BGD>7)f4<hV%taZRJq3Q6~5V3xZ#(aC;r');
define('NONCE_SALT',       'K8^QO$Hk9@G6ZTkT<2LOLNsH.1K7PF7<3%Z!^1Do$J3fv]f|O2z8dKc9zQBz;,,H');

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
if ( ! defined( 'WP_DEBUG') ) {
	define('WP_DEBUG', false);
}

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
  define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
