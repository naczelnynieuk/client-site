<?php use MyApp\Tpl\Helper as Helper;?>

<?php if (!$user): ?>
         <div class="jumbotron jumbotron-fluid bg-dark text-white">
            <div class="container">
                <h1 class="display-4">Panel Klienta</h1>
                <blockquote class="blockquote" style="margin-top: 20px;">
                    <p class="mb-0">Zadowolony Klient to najlepsza strategia biznesowa.</p>
                    <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Somewhere</cite></footer>
                </blockquote>
            </div>
        </div>
<?php endif ?>



<div class="container">
	
<?php if (!Helper::checkLogin()): ?>
	<h2>Witaj na stronie głównej!</h2>




<?php if (isset($flash)) {?>
	<?php foreach ($flash as $value){ ?>
	<div class="alert alert-info" role="alert" style="margin-top: 10px;">
  		<?= escape($value); ?>
	</div>
	<?php } ?>
<?php } ?>

	

<?php else: ?>
<?php if (isset($flash)) {?>
	<?php foreach ($flash as $value){ ?>
	<div class="alert alert-info" role="alert" style="margin-top: 10px;">
  		<?= escape($value); ?>
	</div>
	<?php } ?>
<?php } ?>



<h2>Witaj <?php echo escape($user['username']); ?></h2>



<?php endif ?>








</div>
