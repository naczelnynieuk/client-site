<?php
require('../core/init.php');


try {


if (\MyApp\User::isLogin()) {
	\MyApp\FlashMessage::add('Jesteś już zarejestrowany!');
	\MyApp\Redirect::to('index.php');
	die();
}

//szablon
$tpl = new \MyApp\Tpl\Engine('../templates/'. \MyApp\Config::get('system/default_template'));
$view = $tpl->createView(['header', 'register', 'footer']);

$view->title = \MyApp\Config::get('system/default_title').'-register';
$view->lang = \MyApp\Config::get('system/default_lang');
$view->charset = \MyApp\Config::get('system/charset');
$view->url = \MyApp\Config::get('system/url');


$form = array(
	'username'=>'',
	'email'=>'',
	'order_code'=>''
);




if (isset($_POST['register'])) {
	if (\MyApp\Token::check($_POST['token'])) {

		$form_data = array();

		$form_data[] = new \MyApp\Validation('Nazwa użytkownika',$_POST['username'], [
			'maxlength'=>32,
			'minlength'=>3,
			'notExistDb'=>'users/username'
			]);
		$form_data[] = new \MyApp\Validation('Hasło',$_POST['password'], [
			'maxlength'=>32,
			'minlength'=>3
			]);
		$form_data[] = new \MyApp\Validation('Ponowne Hasło',$_POST['password_reply'], [
			'maxlength'=>32,
			'minlength'=>3,
			'equals'=> $form_data[1]
			]);
		$form_data[] = new \MyApp\Validation('Email',$_POST['email'], [
			'maxlength'=>32,
			'minlength'=>3,
			'notExistDb'=>'users/email'
			]);

		$form_data[] = new \MyApp\Validation('Kod zamówienia',$_POST['order_code'], [
			'existDb'=>'orders/hash',
			'notUsed' => true
			]);

		foreach ($form_data as $data) {
			$data->validate();
		}


		if(!($view->errors = $form_data[0]->getErrors())){
			$user = new \MyApp\User();
			$user->register([
				'username'=>	trim($_POST['username']),
				'password'=>	password_hash(trim($_POST['password']),PASSWORD_DEFAULT),
				'email'=>		trim($_POST['email']),
				'ip' =>			trim($_SERVER['REMOTE_ADDR'])
			]);


			if (!$user->getResult()) {
				\MyApp\FlashMessage::add('Wystąpił błąd podczas dodawania użytkownika do bazy!');
				\MyApp\Redirect::to('register.php');
				die();
			}

			$user = new \MyApp\User(trim($_POST['username']));
			$order = new \MyApp\Order();
			$order -> getOrderByHash($_POST['order_code']);
			
			if ($order->isExists()) {
				echo 'dzialam';
				vA($user->getData()['id']);
				$order->updateByHash([
					'client_id' => $user->getData()['id']
				]);
			}

			\MyApp\FlashMessage::add('Poprawnie zarejestrowano!');
			\MyApp\Redirect::to('index.php');
			die();
		}

		$form = array(
			'username'=>trim($_POST['username']),
			'email'=>trim($_POST['email']),
			'order_code'=>trim($_POST['order_code'])
			);
	}
}



$view->user = null;
$view->form = $form;

$view->render();
}catch (Exception $e) {
	die('Wystąpł błąd: '.$e->getMessage());
}