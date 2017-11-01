<?php use MyApp\Tpl\Helper as Helper;?>
<div class="container">


<?php if (isset($flash)) {?>
	<?php foreach ($flash as $value){ ?>
	<div class="alert alert-info" role="alert" style="margin-top: 10px;">
  		<?= escape($value); ?>
	</div>
	<?php } ?>
<?php } ?>

<?php if (isset($errors)): ?>
	<?php foreach ($errors as $key => $value): ?>
		<div class="alert alert-danger" role="alert" style="margin-top: 10px;">
	  		<?= escape($value); ?>
		</div>
	<?php endforeach ?>
<?php endif ?>



<h2 class="option" style="margin-top: 50px;">Zmien Dane</h2>
<form class="option-body unvisible " method="post">
	<div class="row">
    	<div class="form-group col-md-6">
			<label for="">Email</label>
			<input type="text" name="email" value="<?php echo escape($user['email']); ?>" class="form-control" id="">
      	</div>
	</div>
	<div class="row">
    	<div class="form-group col-md-6">
			<label for="">Numer Telefonu</label>
			<input type="text" name="phone_number" value="<?php echo escape($user['phone_number']); ?>" class="form-control" id="">
      	</div>
	</div>
	<div class="row">
    	<div class="form-group col-md-6">
			<label for="">GG</label>
			<input type="text" name="gg" value="<?php echo escape($user['gg']); ?>" class="form-control" id="">
      	</div>
	</div>
	<div class="row">
    	<div class="form-group col-md-6">
			<label for="">Skype</label>
			<input type="text" name="skype" value="<?php echo escape($user['skype']); ?>" class="form-control" id="">
      	</div>
	</div>





<div class="row">
  <input type="hidden" name="token" value="<?php echo $token =\MyApp\Token::generate();?>">
  <div class="col-md-6">
    <button type="submit" class="btn btn-primary bg-dark btn-block" name="update_basic" >Aktualizuj</button>
   </div>
</div>
</form>





<h2 class="option" style="margin-top: 20px;">Zmien haslo</h2>

<form class= "option-body unvisible" method="post">
	<div class="row">
    	<div class="form-group col-md-6">
			<label for="">Aktualne Hasło</label>
			<input type="password" name="current_password" class="form-control" id="">
      	</div>
	</div>
	<div class="row">
    	<div class="form-group col-md-6">
			<label for="">Nowe Hasło</label>
			<input type="password" name="password" class="form-control" id="">
      	</div>
	</div>
	<div class="row">
    	<div class="form-group col-md-6">
			<label for="">Powtórz Nowe Hasło</label>
			<input type="password" name="password_reply" class="form-control" id="">
      	</div>
	</div>

<div class="row">
  <div class="col-md-6">
  	  <input type="hidden" name="token" value="<?php echo $token; ?>">
    <button type="submit" class="btn btn-primary bg-dark btn-block" name="update_password" >Zmien Hasło</button>
   </div>
</div>
</form>



</div>

<script src="<?php echo $url ?>/js/main.js"></script>
