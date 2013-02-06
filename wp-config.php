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
define('DB_NAME', 'workeet');

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
define('AUTH_KEY',         'If2!qdn(k[QU4EwscoJk_ZkkYVZ=m`/6VvcjX6[z0;#lkhw[0Q$3s=MzGq8BXQTv');
define('SECURE_AUTH_KEY',  '$S{=eWa!0 ?@JmIl[V7bnWbcZ|J 9QV00nu+);-Z+0#Nu7OM[4vrFT@OCu$$ ySW');
define('LOGGED_IN_KEY',    ']Z(JrdzA(32i:jaALt^[mx9a-;.)]dzdkwI-@CGz>ti>}%bH]7fx|%/l:|A%-a&R');
define('NONCE_KEY',        ';XLhM6c4wwPj^a^^O/+l)H[MPyj8-zu5Ip/fz{vv ,(#sRy6TZ|5U;_@?-br+.Y2');
define('AUTH_SALT',        'e0T|m+#!<nU@S{sfYkf4,(-d?&-]JH2$u]mS+@(iEbN+)B(&rnli^YHC+fhR~a~]');
define('SECURE_AUTH_SALT', '-oow+tJ:|_9J[.^r8U3_xIzR%`3W?xgXx/:3 kx0<^ .f-1yK/*h+/4cY1PvtA<:');
define('LOGGED_IN_SALT',   'iY]$*2wc)>>=TUIC8p;tr?R3H 5p|l5wz$fO{At-&u$0hBG|)(%hK6g:[bGVi7#U');
define('NONCE_SALT',       ']EC(PEQo+F}v+HC-:xbn&cb<zqkqr3oDQHpZp90|d*{ZVmmSw+|7kog8eJJW[]10');

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
