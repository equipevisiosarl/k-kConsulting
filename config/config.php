<?php

//defined('ROOTPATH') OR exit('Access Denied!');

define('APP_NAME', "k_k_consulting");
define('APP_DESC', "");

define("WEBSITE_LOGO", "assets/img/logo.jpg");
define("WEBSITE_TITLE", "K&K Consulting");
define("WEBSITE_NAME", "K&K Consulting");
define("WEBSITE_DESCRIPTION", "");
define("WEBSITE_KEYWORDS", "");
define("WEBSITE_LANGUAGE", "Fr");
define("WEBSITE_AUTHOR", "");
define("WEBSITE_AUTHOR_MAIL", "");

// Facebook Open Graph tags
define("WEBSITE_FACEBOOK_NAME", "");
define("WEBSITE_FACEBOOK_DESCRIPTION", "");
define("WEBSITE_FACEBOOK_URL", "");
define("WEBSITE_FACEBOOK_IMAGE", "");

$fxnumero = '<a href="tel:+2250748117720">+225 0748117720</a>';
$fxnumero2 = '<a href="tel:+2250566463276">+225 0566463276</a>';
$fxemail = 'info@k-kconsulting.com';
define("WEBSITE_NUM", $fxnumero );
define("WEBSITE_NUM2", $fxnumero2 );
define("WEBSITE_EMAIL", '<a href="mailto:'.$fxemail.'">'.$fxemail.'</a>');
define("WEBSITE_ADDRESS", 'Abidjan , Cocody, Riviera Palmeraie, 06 BP 2099 Abidjan');

if ((empty($_SERVER['SERVER_NAME']) && php_sapi_name() == 'cli') || (!empty($_SERVER['SERVER_NAME']) && $_SERVER['SERVER_NAME'] == 'localhost')) {
    /** database config **/
    define('DBNAME', '');
    define('DBHOST', '');
    define('DBUSER', '');
    define('DBPASS', '');
    define('DBDRIVER', '');

    define('ROOT', '../');
    define('URL', 'http://localhost/' . APP_NAME . '/');
} else {
    /** database config **/
    define('DBNAME', '');
    define('DBHOST', '');
    define('DBUSER', '');
    define('DBPASS', '');
    define('DBDRIVER', '');

    define('ROOT', 'https://www.k-kconsulting.com/');
    define('URL', ROOT);
}

/** true means show errors **/
define('DEBUG', true);
