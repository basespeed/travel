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
define( 'DB_NAME', 'traveler2' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '{F!H[q|Ikb!URK;ctU7E_}KJk2L_F0iI/%4Pyzrez{[wAt)s}8.lGSQNxfb0c(t;' );
define( 'SECURE_AUTH_KEY',  'oJ?HLLXXN+rIhi[.18=|.f(yj6vR>zg~ U]2v?iD7[0mb5F|aLoH[KJ0(F7#Kl K' );
define( 'LOGGED_IN_KEY',    'W9:agSF]HN!<7=H>XzK/VAbD,f`_%iTPjF+E O>GeT7DtcGFy_lgC74oW#}#mu)6' );
define( 'NONCE_KEY',        '{M=:69d,:(9ajAcB+$Kuo0+/|4Nn*8]FBf$/d/MBEkPv+Eh=6aF@|xydIVaGN~,&' );
define( 'AUTH_SALT',        '%PBD89j|CWi3-aX:Q:palZJ{m#D>VW5!w ,V_lh/hr<S86$GvHC/s(?WjWKMKCJF' );
define( 'SECURE_AUTH_SALT', 'Xok96>)xDuH`)vuF);6HM3klgR<dy59uEHkK!UV=ZRdM}/i>BS#IiO7xby&A)U7$' );
define( 'LOGGED_IN_SALT',   'h#X1/DR[~cB*9.^@B2I>YSY]{0PL2pBMNH[.Wz[ LQsrh~(vtuE&=KS:P8aGK+2-' );
define( 'NONCE_SALT',       'Bit;!M)[bCA{.) V1t<xz@Ed/w&zJ5#_>_E`RNdmfw[=uRSvqB_;qYcUFalIx~a<' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'traveler_';

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
