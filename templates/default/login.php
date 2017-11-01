

<div class="container">


<?php if (isset($errors)): ?>
	<?php foreach ($errors as $key => $value): ?>
		<div class="alert alert-danger" role="alert" style="margin-top: 10px;">
	  		<?= escape($value); ?>
		</div>
	<?php endforeach ?>
<?php endif ?>


<form class="justify-content-md-center margines-top" method="post">
	<div class="row justify-content-md-center">
		<div class="form-group col-md-6">
      		<label for="inputEmail4">Nazwa użytkownika</label>
      		<input type="text" name="username" value="<?php  echo escape($form['username']); ?>" class="form-control" id="inputEmail4">
    	</div>
	</div>
	<div class="row justify-content-md-center">
	    <div class="form-group col-md-6">
	      <label for="inputPassword4">Hasło</label>
	      <input type="password" name="password" class="form-control" id="inputPassword4">
	    </div>
	</div>

	<div class="row justify-content-md-center">
	    <div class="form-group col-md-6">
	    	<label for="inputPassword4">Zapamiętaj mnie</label>
	    	<input type="checkbox" name="remember" checked="on">
	    </div>
	</div>

	<div class="row justify-content-md-center">
		<input type="hidden" name="token" value="<?php echo \MyApp\Token::generate();?>">
		<div class="col-md-4">
		  <button type="submit" class="btn btn-primary bg-dark btn-block" name="login">Zaloguj</button>
		</div>
	</div>
</form>

</div>