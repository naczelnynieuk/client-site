<?php
session_start();
require('C:/xampp/htdocs/client-site/core/functions.php');
spl_autoload_register(function($className){
	require('C:/xampp/htdocs/client-site/classes//'.$className.'.php');
});

\MyApp\Config::downloadConfig('C:/xampp/htdocs/client-site/config/cfg.ini');
//error_reporting(\MyApp\Config::get('system/error_reporting'));

if(\MyApp\Cookie::exists(\MyApp\Config::get('remember/cookie_name')) && !\MyApp\Session::exists(\MyApp\Config::get('session/session_name'))) {

   $hash = \MyApp\Cookie::get(\MyApp\Config::get('remember/cookie_name'));

   $hashCheck = \MyApp\Db::getInstance()->select('sessions', array('hash', '=', $hash));
    if($hashCheck) {
        \MyApp\User::login((int)$hashCheck[0]['user_id']);
    }
}