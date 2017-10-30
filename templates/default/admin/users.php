<?php use MyApp\Tpl\Helper as Helper;?>
<?php if (isset($flash)) {?>
  <h1>Kominkaty:</h1>
  <ul>
  <?php foreach ($flash as $value){ ?>
    <li><?= $value ?></li>
  <?php } ?>
  </ul>
  <br><br><br><br>
<?php } ?>


<h2 class="option">Lista użykowników (nacisnij)</h2>
<div class="option-body unvisible" id="users_list">
<?php foreach ($users as $key => $value) { ?>

  <h2><?php echo escape($value['username']); ?></h2>
  <ul>

  <li>username: <?php echo escape($value['username']); ?></li>
  <li>email: <?php echo escape($value['email']); ?></li>
  <li><?php echo Helper::linkTo('?usun='. escape($value['id']), 'usun') ?></li>

  </ul>
<?php
}
?>
</div>

<h2 class="option">Dodaj użytkownika</h2>
<div class="option-body">
    <form  method="post">
      <label for="">username <input type="text" name="username" value="<?php echo escape($form['username']); ?>"></label><br>
      <label for="">password <input type="text" name="password"></label><br>
      <label for="">email <input type="text" name="email" value="<?php  echo escape($form['email']); ?>"></label><br>
      <input type="hidden" name="token" value="<?php echo \MyApp\Token::generate();?>">
      <input type="submit" value="zarejestruj" name="register">
    </form>
</div>


<?php 
if (isset($errors)) {
  pA($errors);
} ?> 

<script src="<?php echo $url ?>main.js"></script>
