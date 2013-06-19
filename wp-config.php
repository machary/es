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
define('DB_NAME', 'ae');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'ZeN:}I)*v>,18sT)0l:2L%S+yh9W*](|NW<aSY5J/1BbsIq6Nt%rOtxWt{i%$=22');
define('SECURE_AUTH_KEY',  '*CRzWqN~m+!KsPWQ:jfJCs{N?S[]_<UWh06?8%/4(!v|y$PzJNpm%A*THy<MG2.1');
define('LOGGED_IN_KEY',    '[scQ:H;*nrqd`v>&bL4&GSy?(-1Xp.jlPcGyvWeY%>=G6B2*sK<(ASPyiA0M``Z]');
define('NONCE_KEY',        '=eJFK;Qj_cL3B< )IbY>T__n$MP03d3cQgV4:6dj}?fRe:.J3zs[TfJI LLgabwz');
define('AUTH_SALT',        'tNoHg5o4GN{I:cw-bW2i#+1/W`D(n@WUR8>ZA8T!B`JdGfxiEXo8B3;p6d%@30UW');
define('SECURE_AUTH_SALT', 'o7x^NAQqYd[AbW5w8^ue8RC03^O>#fJr3u~%+>nlR1d}HJS#:TRRyNHMmYq=DqHj');
define('LOGGED_IN_SALT',   'W;7-tcj?Q?#DjKJZF%?a_sdJ!4ZPpZA%bT-GG Cf8(gNk1]*B{k Za;Oj&X2e-N#');
define('NONCE_SALT',       'rJG&p{><1b+}-Li-7oif)gs4D.34odxUa+ybh5*_Wn,Z*l,nseDTbppQ2ic12Iv&');

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
