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


<ul>
	<li><?php echo Helper::linkTo('users.php', 'Uzytkownicy') ?></li>
	<li><?php echo Helper::linkTo('orders.php', 'Zamowienia') ?></li>
</ul>





<script src="<?php echo $url ?>main.js"></script>
