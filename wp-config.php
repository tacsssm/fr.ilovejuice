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

define('FS_METHOD', 'direct');


// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'fr_ilovejuice');

/** MySQL database username */
define('DB_USER', 'fr.ilovejuice');

/** MySQL database password */
define('DB_PASSWORD', 'bbuZ48JLfqX9YJf8');

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
define('AUTH_KEY',         'Af:mQ@h%E/Q56piq?[JkZC2Ak/tt:L+6)wt.$KKH$7-S5[MJ1h0Y@9abo%p+EfH;');
define('SECURE_AUTH_KEY',  'pOs`.`(6rhQn@^$cQ{6RCJ{IZ=t_gh|6a7pv$F1k^;%,9RQ077a_y9^$!ruK-r)&');
define('LOGGED_IN_KEY',    '{UquXH*UO-;`z}0+few.m(@:L>}qwkH+RQQ T|u,kA_Y,X`lorQ[D+!o(_M+y&r#');
define('NONCE_KEY',        '41anT1oKI6LA=&|u#B&H-s`J+>T<@`<ye I0SOx-PY%M|`yw-F=`IJ2GrN}#,5%Z');
define('AUTH_SALT',        'J>2+,S`QxjIU,!1lRP|39kNd5w(d>S)66*_K5gjrAzkTg2=]6k%/BAv|4tb:8sgG');
define('SECURE_AUTH_SALT', '^.Ki4`(_i.$:Q|FX/>!g:$0^@oH`Zn(b4E/6]]`@OqR4gHVYHA_+n[_+WZ6P4&4f');
define('LOGGED_IN_SALT',   'g(*!=@|7RFYx+#jKn!cK } u]Emg!wwlf+J&!S3CS<Mqd+pNkq/=[`*ND]V2o|^>');
define('NONCE_SALT',       'ciTn-;_|yT9%_IP!A9QswvdYFk91jG= Lv6`~RPEW6qK?j8+g[L7>]^cp6If&Y| ');

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
// define('WPLANG', '');
define('WPLANG', 'fr_FR');

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

