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
define('DB_NAME', 'ozlens');
/** MySQL database username */
define('DB_USER', 'devloperuser');
/** MySQL database password */
define('DB_PASSWORD', '^lbZ03Bd3Dve');
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
define('AUTH_KEY',         '5:b4g~F0,T[tXz35NzA||wKy N([H~L+4/-i.j_THOQfC 9lx.wCG_-)w4f%t sL');
define('SECURE_AUTH_KEY',  'XcgMnxWCUVi[sJ [a3Gkh&&rcq$YvS,[M}8BodNB5[NVKfx@5j2~^ IEb*{W#0u%');
define('LOGGED_IN_KEY',    'JX_QVu^]:t}B>#.wYa<p[;z!{8Qm_zj.=E3%Z5<{Uefz_k_hBW7t1}j**Eanx2~,');
define('NONCE_KEY',        't$~l]:aKA%JY~.?5c{#nm3A7tGShUn@~ca+!(Tlsnmq5<oX~9}|_`;ZI`gGCYlaG');
define('AUTH_SALT',        'mVmOeV!iL61jrb`5rnKhH/^2hDy6xHnkMLYE6AS}D7?TXb-AHZ$UbgOH1h6-b+?!');
define('SECURE_AUTH_SALT', 'ZkP {Jn]gLS;Mb%N:u)Y/:C6~__ygV9TY&smMMm|DJ3ylrb*U/E4J2K=5 fXI~pK');
define('LOGGED_IN_SALT',   ' p1k8,=X:t Pvj_`k?LEq %U;Lnc:^FzT7[Y9{%U?/.)F!D7sY>yL+6h,44K4+(@');
define('NONCE_SALT',       'gxr;7ev-o}BF/rgH5~;9^DwL^4a_Kl3&6`o?v{z5u*DE#o Xr*]PO}>u_-.LvsvP');
/**#@-*/
/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'ozlb_';
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
