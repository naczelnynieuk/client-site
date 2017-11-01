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
$view = $tpl->createView(['header', 'admin/users', 'footer']);

$view->title = \MyApp\Config::get('system/default_title'). ' - Admin';
$view->lang = \MyApp\Config::get('system/default_lang');
$view->charset = \MyApp\Config::get('system/charset');
$view->url = \MyApp\Config::get('system/url');


$flash = null;
if ($flash = \MyApp\FlashMessage::render()) {
  $view->flash = $flash;
}

    $form = array(
      'username'=>'',
      'email'=>'',
      );

if (isset($_GET['usun'])) {
  $result = \MyApp\Db::getInstance()->delete('users', ['id', '=', trim($_GET['usun']) ]);

  if (!$result) {
    \MyApp\FlashMessage::add('Błąd podczas usuwania użytkownika');
    \MyApp\Redirect::to('admin.php');
    die();
  }

   \MyApp\FlashMessage::add('Pomyślnie usunięto użytkownika');
    \MyApp\Redirect::to('users.php');
    die();
}

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
    $form_data[] = new \MyApp\Validation('Email',$_POST['email'], [
      'maxlength'=>32,
      'minlength'=>3,
      'notExistDb'=>'users/email'
    ]);

    foreach ($form_data as $data) {
      $data->validate();
    }


    if(!($view->errors = $form_data[0]->getErrors())){
      $user = new \MyApp\User();
      $user->register([
        'username'=>  trim($_POST['username']),
        'password'=>  password_hash(trim($_POST['password']),PASSWORD_DEFAULT),
        'email'=>   trim($_POST['email'])
      ], false);


      if (!$user->getResult()) {
        \MyApp\FlashMessage::add('Wystąpił błąd podczas dodawania użytkownika do bazy!');
        \MyApp\Redirect::to('register.php');
        die();
      }


      \MyApp\FlashMessage::add('Poprawnie dodano użytkownika!');
      \MyApp\Redirect::to('users.php');
      die();
    }

    $form = array(
      'username'=>trim($_POST['username']),
      'email'=>trim($_POST['email'])
    );
    $view->form = $form;
  }
}


$userdata=array();

if($user->isExists()){
  $userdata = $user->getData();
  $view->user = $user->getData();
}



$users= \MyApp\Db::getInstance()->select('users');
if ($users) {
  $x=0;
  foreach ($users as $key => $value) {
    if ($value['id'] == $userdata['id']) {
      unset($users[$x]);
    }
    $x++;
  }
  $view ->users = $users;
}




$view->form = $form;

$view->render();


}catch (Exception $e) {
  die('Wystąpł błąd: '.$e->getMessage());
}