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

<h2 class="option">Dodaj zamówienie</h2>
<div class="option-body unvisible">
	<form action="" method="post">
		<label>Nazwa zamówienia: <input type="text" name="order_name"></label><br>
		<label for="">Koder</label>
		<select name="coder" id="">
			<?php foreach ($coders as $key => $value): ?>
				<option value="<?php echo $value['id'] ?>"><?php echo $value['username'] ?></option>
			<?php endforeach ?>
		</select><br>
		<input type="submit" value="Dodaj zamowienie" name ="order">
		<input type="hidden" name="token" value="<?php echo \MyApp\Token::generate();?>">
	</form>
</div>





<script src="<?php echo $url ?>main.js"></script>
