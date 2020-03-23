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
define( 'DB_NAME', 'winn' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', '127.0.0.1' );

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
define( 'AUTH_KEY',         'Zcs@6&#<{7k(,k#1JCxU?<c8YPST+Cc?(&wQYmH v8HFUpFrpO3} tpBMblD]>_Z' );
define( 'SECURE_AUTH_KEY',  '}K]drnkzj)+Q(V~1F1|)M(KJ:Qx.LF0=pf|iFN[yoMEdJTOLN20}Hh|qxz|YT#l6' );
define( 'LOGGED_IN_KEY',    'v#1X#<dvyT4%{jP~k;KN6WYb`S^gsgkRD/$%U?mtbL1Kgb#hp]U]~;ytb}vFLo(0' );
define( 'NONCE_KEY',        'CC,F(Xx$*}z{0M_F-xAm<QnlzCL5cu$NMs+a%g[^G<[vWb>ZD>9_T-@rjXnPO-d6' );
define( 'AUTH_SALT',        'zkM qZ74|N+u$U(17G8-!*?@5C8VT#~Va$>j>o^~#l]-M-1!X+k;PUbAv~a[~O7:' );
define( 'SECURE_AUTH_SALT', 'T9GODiqG*kp#]gEkZ;2rX1s/n?]X>RX<3>TEH];PUd8,QY6Q7jr2:S-e%A.qFdK.' );
define( 'LOGGED_IN_SALT',   'TL&q1Q/.1HC]pP5JYZNlhs.)4 |q;!Ge=)`f;88zVl?r qs.WFnBLIMbHam[vJqx' );
define( 'NONCE_SALT',       '$,Z>]cL?11x~xgU>X4`.94:P.+x*xau7y`UibvQyvMj6g+n2[UjB,-rRK/ld1n(S' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wt_';

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
