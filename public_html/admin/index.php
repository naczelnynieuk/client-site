<?php
require('../../core/init.php');


try {

if (!\MyApp\User::isLogin()) {
  \MyApp\FlashMessage::add('Ooops, nie tym razem złotko:)');
  \MyApp\Redirect::to('index.php');
  die();
}

$user = new \MyApp\User();
if (!$user->isAdmin()) {
  \MyApp\FlashMessage::add('Nie jesteś administratorem!');
  \MyApp\Redirect::to('index.php');
  die();
}




$tpl = new \MyApp\Tpl\Engine(\MyApp\Config::get('system/BASE_URI').'templates/'. \MyApp\Config::get('system/default_template'));
$view = $tpl->createView(['header', 'admin/index', 'footer']);

$view->title = \MyApp\Config::get('system/default_title'). ' - Admin';
$view->lang = \MyApp\Config::get('system/default_lang');
$view->charset = \MyApp\Config::get('system/charset');
$view->url = \MyApp\Config::get('system/url');


$flash = null;
if ($flash = \MyApp\FlashMessage::render()) {
  $view->flash = $flash;
}


$userdata=array();

if($user->isExists()){
  $userdata = $user->getData();
  $view->user = $user->getData();
}

$view->render();


}catch (Exception $e) {
	die('Wystąpł błąd: '.$e->getMessage());
}