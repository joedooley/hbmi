<?php


// ** MySQL settings ** //
/** The name of the database for WordPress */
define('DB_NAME', 'hbmi-local');

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

define('AUTH_KEY',         '<c5-8+Uol4D`R4wQ#wO0~c _c:y{+=X-RYvB!3UT?cIQ%l%Mu}xwhBPCq({~4Bs&');
define('SECURE_AUTH_KEY',  '4+l+NdhrsT{FD+8X4zB]#UG<ANYoe,j/+pnzIrR-Q;ZJ-X/^_,B1Gd!V@24UI*e)');
define('LOGGED_IN_KEY',    'CUsB,JAm *LSIq]ysuwoDsw8.@+&Q=/}Cofi FRJ$|%yn,f&Re$QZK{1wAd*{/L|');
define('NONCE_KEY',        '#bg$GCAY]1L@b[vkcKZ1mxP?duHH&}&8%25%=QSl*<K?mRc%Q!/c3l&uI>%mOfdH');
define('AUTH_SALT',        'Hub>=!FpE0whW%5#aE+wh)#>JLl|F}TIBfbj0GYoZ@-bPi);b+~)+zE}F]XR<p|z');
define('SECURE_AUTH_SALT', 'zRAgwra`1aiM(kiKMFdu(Muv{$k]a75~9;#434NJ{GzEzzYwJm5&s+b2/3QNXp8%');
define('LOGGED_IN_SALT',   '6!.Xnb8wkkNiY|#d~cpX,(N-oacGN@BPoXhwY:7&y O}HGwDQ{7sDa}iD`P7f7Dw');
define('NONCE_SALT',       '1W{H -+QW_XACoz_oU--p-zZ)P{mm3K2R(g#P|`|Z-ARodJ/`^}!4fVRlNtVPzg-');


$table_prefix = 'wp_';


define('WP_DEBUG', true);
define('WP_DEBUG_DISPLAY', false);
define('WP_DEBUG_LOG', true);
define('SCRIPT_DEBUG', true);
define('JETPACK_DEV_DEBUG', true);


/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

