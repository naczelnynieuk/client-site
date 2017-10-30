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
$view = $tpl->createView(['header', 'admin/orders', 'footer']);

$view->title = \MyApp\Config::get('system/default_title'). ' - Admin';
$view->lang = \MyApp\Config::get('system/default_lang');
$view->charset = \MyApp\Config::get('system/charset');
$view->url = \MyApp\Config::get('system/url');


$flash = null;
if ($flash = \MyApp\FlashMessage::render()) {
  $view->flash = $flash;
}



if (isset($_POST['order'])) {
  if (\MyApp\Token::check($_POST['token'])){
    $form_data = array();

    $form_data[] = new \MyApp\Validation('Nazwa zamówienia',$_POST['order_name'], [
      'maxlength'=>100,
      'minlength'=>1,
      'notExistDb'=>'orders/name'
      ]);

    $form_data[] = new \MyApp\Validation('Koder',$_POST['coder'], [
      'existDb'=>'permissions/user_id'
      ]);

    $form_data[] = new \MyApp\Validation('Hash',$hash = substr(\MyApp\Hash::unique(),0,12), [
      'notExistDb'=>'orders/hash'
      ]);



    foreach ($form_data as $data) {
      $data->validate();
    }

    if(!($view->errors = $form_data[0]->getErrors())){
          $order = new \MyApp\Order();
          $order->add([
            'coder_id' => trim($_POST['coder']),
            'name' => trim($_POST['order_name']),
            'hash' => $hash
          ]);
    }
  }
}


$coders = \MyApp\Db::getInstance()->getSpecialUsers(2);
if ($coders) {
  $view->coders = $coders;
}

$userdata=array();

if($user->isExists()){
  $userdata = $user->getData();
  $view->user = $user->getData();
}


$users= \MyApp\Db::getInstance()->select('users');
if ($users) {
  $view ->users = $users;
}

$view->render();


}catch (Exception $e) {
	die('Wystąpł błąd: '.$e->getMessage());
}