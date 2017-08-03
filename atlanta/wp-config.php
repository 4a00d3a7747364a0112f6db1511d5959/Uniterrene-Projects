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
define('DB_NAME', 'spaatlanta');

/** MySQL database username */
define('DB_USER', 'spaatlanta');

/** MySQL database password */
define('DB_PASSWORD', '3kAf2{lNa4xz');

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
define('AUTH_KEY',         'Zo +fEBva!OfUlYB0)4@>q(1p0`)0FzjCZXud6{-5e]VEw @ Z=mZ+%mU!(ADo(.');
define('SECURE_AUTH_KEY',  '` WkL7=pSY`1sN[_&9$wr_SMPA*4<6~4TcObQBC[I,rmOq5,=s7e $b{r$$A}EY(');
define('LOGGED_IN_KEY',    'X^TV*p;GL4yfn5.XQQ *%gc#CANl|?|qFOE?Qz`1)+c@:hc;,p&?jlcxHC+q3)YT');
define('NONCE_KEY',        '!rZA}M3`L0?gNLer)CN y[m5dvQx#uK({:WZ&qVUo^=/rbYelRig(Q/W}v5Lbyui');
define('AUTH_SALT',        'kMvS{YrRyw~i~u[&B]V>9YTVAcHKrv,x&>!ctRHchb`^dBPk>!I<;e{%cpZu%i`b');
define('SECURE_AUTH_SALT', ';AM&}aL1)P:os~sA!,dv_NkQ-rf#C,w|tu:eLx565GKg)C8_4hZRA_VIm-r*%c<5');
define('LOGGED_IN_SALT',   '2Ds3-LY{`coG+a?cw/Hpn$Db5<aD3DCHp)b;/JPXwvGN2*>XY%C,cj~#zdH%Im*<');
define('NONCE_SALT',       '^A>HZLA[}p,2(6!c?yKw:#<Uf)_c_+7&w2z}b7lDIrT._urBXidb#43K;?^)GyCk');

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

