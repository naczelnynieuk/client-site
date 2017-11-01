<?php use MyApp\Tpl\Helper as Helper;?>

<div class="container">
<?php if (isset($flash)) {?>
	<h1>Kominkaty:</h1>
	<ul>
	<?php foreach ($flash as $value){ ?>
		<li><?= $value ?></li>
	<?php } ?>
	</ul>
	<br><br><br><br>
<?php } ?>


<div class="list-group" style="margin-top: 90px;">

  <a href="users.php" class="list-group-item list-group-item-action">Uzytkownicy</a>
  <a href="orders.php" class="list-group-item list-group-item-action">Zamówienia</a>
</div>




</div>

<script src="<?php echo $url ?>main.js"></script>
