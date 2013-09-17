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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         ':g?hqSaBTfKg&Lp!`JC-EvnK{G];8L.}$Zj:X<1B!5HPi<w]*&T<GJh4Y!SoL+g4');
define('SECURE_AUTH_KEY',  '!G-V{[lUvlZd]+J|DGSV^m-7>T3OY~Eos^3mo$X8$#md7&BMa9sIp!,^)F+/sSkJ');
define('LOGGED_IN_KEY',    'ld<YWit+lb[nZ#E^,<!%!e8_zA/?f-.:jr1x~kJ?+XW!j6om{6_?Wm]Jxud4TPZb');
define('NONCE_KEY',        'D4<QgW89YP%?|O9mY5L+5eadfOKdcM*?x1BYw(<%sJluOKQ}%AP}MKEdCuSV<a+`');
define('AUTH_SALT',        '7=KM(5Ib/|,&9dBkRT<G.=}K<-{IM#GgTo.h#9~zoU$;]nL3K`+/i;fCYm`=HNvS');
define('SECURE_AUTH_SALT', 'Rr=Zg*N ,p/&x$ jN?!v0ZA5t0.T.4K`1|Qw/z]U69hFTq!v+b-UZm/OY?*A8ICW');
define('LOGGED_IN_SALT',   'brM`?R{Uv75(|{:MkIZOO%$P(]Z4ssih{C}lxP>$<u`{`<9n *y.%j|,@X3arf*f');
define('NONCE_SALT',       'D-gt}<hIqY>5el&)3eR^S^>Q;S|t*w<9n>K!pi*etY![5wR8-gc7eM=|+85Y^F5c');

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
