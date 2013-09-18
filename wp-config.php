<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'benbrany_radleysboo');

/** MySQL database username */
define('DB_USER', 'benbrany_pyro');

/** MySQL database password */
define('DB_PASSWORD', 'Xl1030ba!');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'q=^aWohX[OJa4g)rO}1fH|o+|vcVr=zs:sDjPhAAM&h$%H=@-IHdt|kO)!LABfz-');
define('SECURE_AUTH_KEY',  '^2NT=2yA%,-LP(u.6~|mFDh h]lLHcNz3XIeZ`q(nyV<rvk5n-W)7Gw*/ %Wb*>y');
define('LOGGED_IN_KEY',    'JzfSshbMf[iY|7Q@.I&$E`4pJMi|o%X3j|3EAvv] pJez[_J J!3@::tN02rMQ.-');
define('NONCE_KEY',        '7:NIs#2p]UR#Nh$VrX{J)|-LM~+6.3p%`84R-HevD;~P*-%~+Kch}zYVc6PmRlx/');
define('AUTH_SALT',        '9LuR`1OBWvXG%/TEie?|Q`3>_L!@Y52+apQhdI|dp.;#5t|,-FE(w3&5q~?<&bIB');
define('SECURE_AUTH_SALT', 'I`_[//R0o!3_T=5oF}%C4}=861v3X*-KlqKbTAs=6g(:zdVB-]jb15,mRA!o+ZTd');
define('LOGGED_IN_SALT',   '/Iz<B34`-xhR3DYi.[!`9%X6MDWz)d>B,.q@E@O)vP={7%6N1WAV{C{9=$GW]$d|');
define('NONCE_SALT',       '+d,R|u6+8LRx-0e,|Nbo&`i8&U@pLw;%vR`rqJ n#+|:R}pF-Iy?X!m8(Wr3*!|>');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
