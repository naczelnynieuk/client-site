<?php
require('../core/init.php');

try {

$tpl = new \MyApp\Tpl\Engine('../templates/'. \MyApp\Config::get('system/default_template'));
$view = $tpl->createView(['header', 'page', 'footer']);

$view->lang = \MyApp\Config::get('system/default_lang');
$view->charset = \MyApp\Config::get('system/charset');
$view->url = \MyApp\Config::get('system/url');

 
$flash = null;
if ($flash = \MyApp\FlashMessage::render()) {
  $view->flash = $flash;
}


$userdata=array();

if (isset($_GET['user'])) {
	$user = new \MyApp\User($_GET['user']);
	if ($user->isExists()) {
		$userdata = $user->getData();


	foreach ($userdata as $key => $value) {
		if ($value == '0') {
			$userdata[$key] = '';
		}
	}

		$view->user = $userdata;
		$view->title = $userdata['username'];
	}else {
		\MyApp\FlashMessage::add('Podany uzytkownik nie istnieje!');
		\MyApp\Redirect::to('index.php');
		die();
	}
} elseif (\MyApp\User::isLogin()) {
	$user = new \MyApp\User();
	if ($user->isExists()) {
		$userdata = $user->getData();


	foreach ($userdata as $key => $value) {
		if ($value == '0') {
			$userdata[$key] = '';
		}
	}


		$view->user = $userdata;
		$view->title = $userdata['username'];
	}
} else {
	\MyApp\FlashMessage::add('Wystąpił błąd podczas wyswietlania profilu!');
	\MyApp\Redirect::to('index.php');
	die();
}


$view->render();



}catch (Exception $e) {
	die('Wystąpł błąd: '.$e->getMessage());
}