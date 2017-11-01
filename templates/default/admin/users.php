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
<h2 class="option margines-top">Lista użykowników (nacisnij)</h2>
<div class="option-body unvisible" id="users_list" style="margin-top: 20px;">




<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Id</th>
      <th scope="col">Username</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">GG</th>
      <th scope="col">SKYPE</th>
      <th scope="col">IP</th>
      <th scope="col">Usun</th>
    </tr>
  </thead>
  <tbody>
    <?php $x=1; ?>
    <?php foreach ($users as $key => $value): ?>
     <tr>
      <th scope="row"><?php echo $x; ?></th>
      <td><?php echo escape($value['id']); ?></td>
      <td><a href="<?php echo $url.'page.php?user='.escape($value['username']); ?>"><?php echo escape($value['username']); ?></a></td>
      <td><?php echo escape($value['email']); ?></td>
      <td><?php echo escape($value['phone_number']); ?></td>
      <td><?php echo escape($value['gg']); ?></td>
      <td><?php echo escape($value['skype']); ?></td>
      <td><?php echo escape($value['ip']); ?></td>
      <td><?php echo Helper::linkTo('?usun='. escape($value['id']), 'usun') ?></td>
    </tr>  
    <?php $x++; ?>   
    <?php endforeach ?>
  </tbody>
</table>








</div>

<h2 class="option" style="margin-top: 20px;">Dodaj użytkownika</h2>
<div class="option-body unvisible" style="margin-top: 20px;">



<form class= margines-top" method="post">
  <div class="row">
    <div class="form-group col-md-6">
          <label for="inputEmail4">Nazwa użytkownika</label>
          <input type="text" name="username" value="<?php  echo escape($form['username']); ?>" class="form-control" id="inputEmail4">
      </div>
  </div>
  <div class="row">
      <div class="form-group col-md-6">
        <label for="inputPassword4">Hasło</label>
        <input type="password" name="password" class="form-control" id="inputPassword4">
      </div>
  </div>
  <div class="row" >
      <div class="form-group col-md-6">
        <label for="inputEmail4">Email</label>
        <input type="email" name="email" value="<?php  echo escape($form['email']); ?>" class="form-control" id="inputEmail4">
      </div>
  </div>



<div class="row">
  <input type="hidden" name="token" value="<?php echo \MyApp\Token::generate();?>">
  <div class="col-md-6">
    <button type="submit" class="btn btn-primary bg-dark btn-block" name="register" >Dodaj uzytkownika</button>
   </div>
</div>
</form>


</div>


</div>
<script src="<?php echo $url ?>/js/main.js"></script>
