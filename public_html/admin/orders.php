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
      'minlength'=>3,
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
            'client_id' => trim($_POST['client']),
            'name' => trim($_POST['order_name']),
            'hash' => $hash
          ]);
          \MyApp\FlashMessage::add('Poprawnie dodano zamówienie!');
          \MyApp\Redirect::to('orders.php');
          die();
    }
  }
}


if (isset($_GET['usun'])) {
  if (\MyApp\Token::check($_GET['token'])){
  $result = \MyApp\Db::getInstance()->delete('orders', ['id', '=', trim($_GET['usun']) ]);
  $result = \MyApp\Db::getInstance()->delete('orders_messages', ['order_id', '=', trim($_GET['usun']) ]);


   \MyApp\FlashMessage::add('Pomyślnie usunięto zamówienie');
    \MyApp\Redirect::to('orders.php');
    die();
  }
}









if (isset($_GET['edytuj'])) {

  if (isset($_POST['order_update'])) {
    if (\MyApp\Token::check($_POST['token'])){


        $user->update('orders', ['id','=', $_GET['edytuj']], [
          'name' => trim($_POST['order_name']),
          'coder_id' => $_POST['coder'],
          'client_id' => $_POST['client'],
          'description' => trim($_POST['description']),
          'status' => trim($_POST['status']),
          'url' => $_POST['url'],
          'beg_date' => $_POST['beg_date'],
          'end_date' => $_POST['end_date']
        ]);
        \MyApp\FlashMessage::add('Poprawnie zaktualizowano dane!');
        \MyApp\Redirect::to('orders.php?edytuj='.$_GET['edytuj']);
        die();

    }
  }


    $order = new \MyApp\Order();
    $order->getById(trim($_GET['edytuj']));
    $order->addNames();

    $orderdata = $order->getData();
    if ($order->isExists()) {
      foreach ($orderdata as $key => $value) {
        if ($value === '0') {
          $orderdata[$key] = '';
        }
      }
      $view->order = $orderdata;
    }else {
       $view->order = '';
    }

}else {
  $view->order = '';
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


$orders= \MyApp\Db::getInstance()->select('orders');

if ($orders) {


    $maximum = count($orders);

    for ($i=0; $i <$maximum ; $i++) { 
      $orders[$i]['coder_name'] = \MyApp\Db::getInstance()->getCoderNameFromOrders($orders[$i]['coder_id'] );
      $orders[$i]['client_name'] = \MyApp\Db::getInstance()->getClientNameFromOrders($orders[$i]['client_id'] );
    }
    
    $view->orders = $orders;
}else {
  $view ->orders = null;
}

$users= \MyApp\Db::getInstance()->select('users');
if ($users) {
  $view ->users = $users;
}

$view->render();


}catch (Exception $e) {
	die('Wystąpł błąd: '.$e->getMessage());
}