<div class="container bootstrap snippet">
    <div class="row">
		<div class="col-md-4 bg-white">
            <div style="margin-bottom: 20px; margin-top: 50px;">
            	<h2 class="display-4 text-center">Zamówienia</h2>
            </div>
            
            <!-- =============================================================== -->
            <!-- member list -->
            <ul class="friend-list">
            <?php foreach ($orders as $key => $value): ?>
                <li class="bounceInDown <?php if ($active == $value['id']): ?> active<?php endif ?>">
                	<a href="?order=<?php echo escape($value['id']);?>" class="clearfix">
                		<img src="<?php echo $url ?>img/order.png" alt="" class="img-circle">
                		<div class="friend-name">
                			<?php if (strlen($value['name'])>27): ?>
                				<strong><?php echo escape(substr($value['name'],0,27). '...'); ?></strong>
                			<?php else: ?>
                				<strong><?php echo escape($value['name']); ?></strong>
                			<?php endif ?>
                		</div>
                		<div class="last-message text-muted" style="padding-left: 10px;">Witaj, w czym mogę pomóc?</div>
                		<small class="time text-muted">Just now</small>
                		<small class="chat-alert label label-danger">1</small>
                	</a>
                </li>            	
            <?php endforeach ?>          
            </ul>
		</div>
        
        <!--=========================================================-->
        <!-- selected chat -->
    	<div class="col-md-8 bg-white ">
            <div class="chat-message" style="min-height: 600px;">


                <ul class="chat">

            	<?php if (!$messages): ?>
                    <li class="right clearfix text-right">
                    	<span class="chat-img pull-right text-right">
                    		<img src="<?php echo $url ?>img/admin.png" alt="User Avatar">
                    	</span>
                    	<div class="chat-body clearfix">
                    		<div class="header">
                    				<strong class="primary-font">Coder</strong>
                    			<small class="pull-right text-muted"><i class="fa fa-clock-o"></i> Zawsze</small>
                    		</div>
                    		<p>
                    			Witaj, w czym mogę pomóc? 
                    		</p>
                    	</div>
                    </li>
            	<?php endif ?>

			<?php $iteruj1 = true; $iteruj2=true;?>
           	<?php foreach ($messages as $key => $value): ?>
           		<?php if ($value['user_id'] == $client['id']): ?>
           			<?php $iteruj2 =true;?>
					<li class="left clearfix">
           			<?php if ($iteruj1): ?>
           				<span class="chat-img pull-left">
                    		<img src="<?php echo $url ?>img/user.png" alt="User Avatar">
                    	</span>
           			<?php endif ?>
                    	<div class="chat-body clearfix">
                    		<div class="header">
                    			<?php if ($iteruj1): ?>
                    			<strong class="primary-font"><a href="page.php?user=<?php echo $client['id']; ?>">[klient] <?php echo escape($client['username']);?></a></strong>	
                    			<?php endif ?>
                    			<small class="pull-right text-muted"><i class="fa fa-clock-o"></i> <?php echo escape($value['date']); ?></small>
                    		</div>
                    		<p>
                    			<?php echo escape($value['message']); ?>
                    		</p>
                    	</div>
                    </li>
                    <?php $iteruj1 = false; ?>

           		<?php endif ?>

           		<?php if ($value['user_id'] == $coder['id']): ?>
           			<?php $iteruj1 = true; ?>
                    <li class="right clearfix text-right">
                    	<?php if ($iteruj2): ?>
                    	<span class="chat-img pull-right text-right">
                    		<img src="<?php echo $url ?>img/admin.png" alt="User Avatar">
                    	</span>
                    	<?php endif ?>
                    	<div class="chat-body clearfix">
                    		<div class="header">
                    			<?php if ($iteruj2): ?>
                    				<strong class="primary-font"><a href="page.php?user=<?php echo $coder['id']; ?>">[coder] <?php echo escape($coder['username']);?></a></strong>
                    			<?php endif ?>
                    			<small class="pull-right text-muted"><i class="fa fa-clock-o"></i> <?php echo escape($value['date']); ?></small>
                    		</div>
                    		<p>
                    			<?php echo escape($value['message']); ?>
                    		</p>
                    	</div>
                    </li>
                    <?php $iteruj2 = false; ?>
           		<?php endif ?>
           	<?php endforeach ?>
                            
                </ul>


            </div>
            <div class="chat-box bg-secondary">
            	 <?php if (isset($errors)): ?>
<?php foreach ($errors as $key => $value): ?>
	<div class="alert alert-danger" role="alert" style="margin-top: 10px;">
  		<?= escape($value); ?>
	</div>
<?php endforeach ?>
 	<?php endif ?>
            	<form method="post">
	            	<div class="input-group">
	            		<input class="form-control border no-shadow no-rounded" placeholder="Wpisz tutaj wiadomosc..." name="message">
	            		<span class="input-group-btn">
	            			<button class="btn btn-success no-rounded" type="submit" name="message_form">Wyślij</button>
	            		</span>
	            	</div><!-- /input-group -->	
	            </form>
            </div>            
		</div>        
	</div>
</div>