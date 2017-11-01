<?php
require('../core/init.php');

try {
//system szablonow
$tpl = new \MyApp\Tpl\Engine('../templates/'. \MyApp\Config::get('system/default_template'));
$view = $tpl->createView(['header', 'orders', 'footer']);


$view->title = \MyApp\Config::get('system/default_title');
$view->lang = \MyApp\Config::get('system/default_lang');
$view->charset = \MyApp\Config::get('system/charset');
$view->url = \MyApp\Config::get('system/url');

//wiadomosci flash
$flash = null;
if ($flash = \MyApp\FlashMessage::render()) {
  $view->flash = $flash;
}


$user = new \MyApp\User();
if($user->isExists()){
	$userdata = $user->getData();
	foreach ($userdata as $key => $value) {
		if ($value === "0") {
			$userdata[$key] = '';
		}
	}
	$view->user = $userdata;



if (isset($_GET['order'])) {
	$order = new \MyApp\Order();
	$order->getById(trim($_GET['order']));

	if (!$order->isExists()) {
			\MyApp\Redirect::to('orders.php');
			die();
	}

	$client = new \MyApp\User($order->getData()['client_id']);

	$coder = new \MyApp\User($order->getData()['coder_id']);
	$view -> client = $client->getData();
	$view -> coder = $coder->getData();
	$view -> active = trim($_GET['order']);

	$order->dlMessages();
	if ($order->isExists()) {
		$view->messages = $order->getMessages();
	}else {
		$view->messages = array();
	}

	if (isset($_POST['message_form'])) {
		$form_data = array();

		$form_data[] = new \MyApp\Validation('Wiadomość',$_POST['message'], [
			'minlength'=>3
		]);
		foreach ($form_data as $data) {
			$data->validate();
		}

		if(!($view->errors = $form_data[0]->getErrors())){
			$order->addMessage($userdata['id'], trim($_POST['message']));
			\MyApp\Redirect::to('orders.php?order='.$_GET['order']);
			die();
		}
	}

}





if ($userdata['permission'] == 0 ) {
	$orders = \MyApp\Db::getInstance()->select('orders', ['client_id','=', $userdata['id']]);
	$view->orders = $orders;
}
if ($userdata['permission'] > 0 ) {
	$orders = \MyApp\Db::getInstance()->select('orders', ['coder_id','=', $userdata['id']]);
	$view->orders = $orders;
}



if (!isset($_GET['order']) && $orders) {

	$order = new \MyApp\Order();
	$order->getById(trim($orders[0]['id']));

	$client = new \MyApp\User($order->getData()['client_id']);
	$coder = new \MyApp\User($order->getData()['coder_id']);

	$view -> client = $client->getData();
	$view -> coder = $coder->getData();
	$view ->active = $orders[0]['id'];
	$order->dlMessages();
	if ($order->isExists()) {
		$view->messages = $order->getMessages();
	}else {
		$view->messages = array();
	}

	if (isset($_POST['message_form'])) {
		$form_data = array();

		$form_data[] = new \MyApp\Validation('Wiadomość',$_POST['message'], [
			'minlength'=>3
		]);
		foreach ($form_data as $data) {
			$data->validate();
		}

		if(!($view->errors = $form_data[0]->getErrors())){
			$order->addMessage($userdata['id'], trim($_POST['message']));
			\MyApp\Redirect::to('orders.php?order='.$orders[0]['id']);
			die();
		}
	}

} else if(!isset($_GET['order']) && !$orders){
	\MyApp\FlashMessage::add('Nie masz żadnych zamówień, skontaktuj się z adminem! ');
	\MyApp\Redirect::to('index.php');
	die();
}




}else{
	\MyApp\FlashMessage::add('Zaloguj się!');
	\MyApp\Redirect::to('index.php');
	die();
}




$view->render();


}catch (Exception $e) {
	die('Wystąpł błąd: '.$e->getMessage());
}
