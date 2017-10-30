<body>
<h2>Zarejestruj się!</h2>
<form action="register.php" method="post">
	<label for="">username <input type="text" name="username" value="<?php echo escape($form['username']); ?>"></label><br>
	<label for="">password <input type="text" name="password"></label><br>
	<label for="">password reply<input type="text" name="password_reply"></label><br>
	<label for="">email <input type="text" name="email" value="<?php  echo escape($form['email']); ?>"></label><br>
	<label for="">Kod zamówienia: <input type="text" name="order_code" value="<?php  echo escape($form['order_code']); ?>"></label><br>
	<input type="hidden" name="token" value="<?php echo \MyApp\Token::generate();?>">
	<input type="submit" value="zarejestruj" name="register">
</form>

<?php 
if (isset($errors)) {
	pA($errors);
} ?>
</body>