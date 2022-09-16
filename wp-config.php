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
define( 'DB_NAME', 'wp_lpviettel' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         'TK{*cI+uz|`^;+;wpS8$ChYgAexFwvP<Lgf:z.-p]HG>}6(L#Mm!j2v=3^rZy*!4' );
define( 'SECURE_AUTH_KEY',  '/ALk+zf(w]*R)H*py?)TrngehX[lTqo*yK:S?]x51a!@e&48lU*Udz)nr3^t<ITp' );
define( 'LOGGED_IN_KEY',    '6CiMH7<]g9M8O_l6AsIA,^SNw]fxJf;n2q-q1!>^5C[VwNjOAl=6S+:/k~nm{=V{' );
define( 'NONCE_KEY',        'Dl].?mj/q-_N+Hj`Z:H1i`x-5n0/(n;B=TKbN8lM|@.ctIsTO*BxpYFjdSYzSwC=' );
define( 'AUTH_SALT',        'sf1>^;ax$QNtM(W8JK%:Z[@P7gy%oqhTZI>p`o6_u Y3XF7$K>dQ!!Cp%XktTe{T' );
define( 'SECURE_AUTH_SALT', 'Eshp;!b=)8f6Y)v{Y5+x_3sdF1*x>*cUR|=L)&Z}w2Y_:9$:`![IDhJ!mJ=C*;kZ' );
define( 'LOGGED_IN_SALT',   ';@]FPq-QW(15->44RO7*>Y%YEO#a_(~b5.QefL/Z? 3;`2)@0AxN35U8vD+Z-!jT' );
define( 'NONCE_SALT',       '+<;n$@/*_WitUpK6X~[k]e8AEfedt3R>-L/r%avwQ!rWr; Bg1;-0Ou&?a_dscVz' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'kbw_';

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
define('WP_DEBUG', false);
//kbwcustom
//define('WP_DEBUG', true);
//define('WP_DEBUG_LOG', true);
//define('WP_DEBUG_DISPLAY', true);
//define('SCRIPT_DEBUG', true);

/* Add any custom values between this line and the "stop editing" line. */

//kbwcustom: Multi Domain for a site
// define('WP_SITEURL', '//' . $_SERVER['HTTP_HOST']);
// define('WP_HOME', '//' . $_SERVER['HTTP_HOST']);

//kbwcustom
define('WP_AUTO_UPDATE_CORE', false);  //Disable auto update
define('WP_POST_REVISIONS', false);      //Stop Revision post
define('DISALLOW_FILE_EDIT', true);      //Disable edit file (theme/plugin)
//define('DISALLOW_FILE_MODS',true);     //Disable install theme/plugin

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
