<?php use MyApp\Tpl\Helper as Helper;?>
<div class="container">



<?php if (isset($flash)) {?>
	<?php foreach ($flash as $value){ ?>
	<div class="alert alert-info" role="alert" style="margin-top: 10px;">
  		<?= escape($value); ?>
	</div>
	<?php } ?>
<?php } ?>




<?php if ($order): ?>

<form class="justify-content-md-center margines-top" method="post">
  <div class="row justify-content-md-center">
    <div class="form-group col-md-6">
          <label for="inputEmail4">Nazwa zlecenia</label>
          <input type="text" name="order_name" value="<?php  echo escape($order['name']); ?>" class="form-control" id="inputEmail4">
      </div>
  </div>
  <div class="row justify-content-md-center">
      <div class="form-group col-md-6">
        <label for="inputEmail4">Opis</label>
        <textarea class="form-control" name="description" id="" rows="10"><?php  echo escape($order['description']); ?></textarea>
      </div>
  </div>

  <div class="row justify-content-md-center">
      <div class="form-group col-md-6">
        <label for="inputPassword4">Klient przypisany do zamówienia</label>
      <select name="client" id="" class="form-control">
            <option value="0">brak</option>
        <?php foreach ($users as $key => $value): ?>
            <?php if ($order['client_id'] == $value['id']): ?>
              <option value="<?php echo $value['id'] ?>" selected><?php echo $value['username'] ?></option>
            <?php else: ?>
              <option value="<?php echo $value['id'] ?>"><?php echo $value['username'] ?></option>
            <?php endif ?>
        <?php endforeach ?>
      </select><br>
      </div>
  </div>
  <div class="row justify-content-md-center">
      <div class="form-group col-md-6">
        <label for="inputPassword4">Koder przypisany do zamówienia</label>
      <select name="coder" id="" class="form-control">
        <?php foreach ($coders as $key => $value): ?>
          <?php if ($order['coder_id'] == $value['id']): ?>
            <option value="<?php echo $value['id'] ?>" selected><?php echo $value['username'] ?></option>
          <?php else: ?>
            <option value="<?php echo $value['id'] ?>"><?php echo $value['username'] ?></option>
          <?php endif ?>
        <?php endforeach ?>
      </select><br>
      </div>
  </div>
  <div class="row justify-content-md-center">
      <div class="form-group col-md-6">
        <label for="inputPassword4">Status</label>
        <select name="status" id="" class="form-control">
          <option value="0" <?php if ($order['status'] == 0): ?> selected<?php endif ?>>POCZEKALNIA</option>
          <option value="1" <?php if ($order['status'] == 1): ?> selected<?php endif ?>>W TRAKCIE</option>
          <option value="2" <?php if ($order['status'] == 2): ?> selected<?php endif ?>>ZAKOŃCZONE</option>
        </select>
      </div>
  </div>
  <div class="row justify-content-md-center">
      <div class="form-group col-md-6">
        <label for="inputPassword4">URL</label>
        <input type="text" name="url" class="form-control" id="inputPassword4" value="<?php  echo escape($order['url']); ?>">
      </div>
  </div>
  <div class="row justify-content-md-center">
      <div class="form-group col-md-6">
        <label for="inputPassword4">Data rozpoczęcia</label>
        <input type="text" name="beg_date" class="form-control" id="inputPassword4" value="<?php  echo escape($order['beg_date']); ?>">
      </div>
  </div>
  <div class="row justify-content-md-center">
      <div class="form-group col-md-6">
        <label for="inputPassword4">Data zakonczenia</label>
        <input type="text" name="end_date" class="form-control" id="inputPassword4" value="<?php  echo escape($order['end_date']); ?>">
      </div>
  </div>
<div class="row justify-content-md-center">
  <input type="hidden" name="token" value="<?php echo \MyApp\Token::generate();?>">
  <div class="col-md-4">
    <button type="submit" class="btn btn-primary bg-dark btn-block" name="order_update" >Aktualizuj</button>
   </div>
</div>
</form>


<?php else: ?>
  






<h2 class="option" style="margin-top: 60px;">Dodaj zamówienie</h2>
  <div class="option-body unvisible" style="margin-top: 20px;">

<form class= margines-top" method="post">
  <div class="row">
    <div class="form-group col-md-6">
          <label for="inputEmail4">Nazwa zamówienia</label>
          <input type="text" name="order_name"  class="form-control" id="inputEmail4">
      </div>
  </div>



  <div class="row">
      <div class="form-group col-md-6">
        <label for="inputPassword4">Koder przypisany do zamówienia</label>
      <select name="coder" id="">
        <?php foreach ($coders as $key => $value): ?>
          <option value="<?php echo $value['id'] ?>"><?php echo $value['username'] ?></option>
        <?php endforeach ?>
      </select><br>
      </div>
  </div>


  <div class="row">
      <div class="form-group col-md-6">
        <label for="inputPassword4">Klient przypisany do zamówienia</label>
      <select name="client" id="">
        <option value="0">brak</option>
        <?php foreach ($users as $key => $value): ?>
          <option value="<?php echo $value['id'] ?>"><?php echo $value['username'] ?></option>
        <?php endforeach ?>
      </select><br>
      </div>
  </div>

<div class="row">
  <input type="hidden" name="token" value="<?php echo $token = \MyApp\Token::generate();?>">
  <div class="col-md-6">
    <button type="submit" class="btn btn-primary bg-dark btn-block" name="order" >Dodaj zamowienie</button>
   </div>
</div>
</form>
  </div>





<h2 style="margin-top: 30px;">Lista zamówień</h2>

<table class="table" style="margin-top: 20px;">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nazwa</th>
      <th scope="col">Klient</th>
      <th scope="col">Koder</th>
      <th scope="col">Status</th>
      <th scope="col">Hash</th>
      <th scope="col">Akcje</th>
    </tr>
  </thead>
  <tbody>

    <?php if ($orders): ?>
    <?php $x=1; ?>
    <?php foreach ($orders as $key => $value): ?>
     <tr>
      <th scope="row"><?php echo $x; ?></th>
      <td><?php echo escape($value['name']); ?></td>
      <td><?php echo escape($value['client_name']); ?></td>
      <td><?php echo escape($value['coder_name']); ?></td>
      <td><?php if ($value['status'] == 0): ?>POCZEKALNIA<?php endif ?>
          <?php if ($value['status'] == 1): ?>W TRAKCIE<?php endif ?>
          <?php if ($value['status'] == 2): ?>ZAKOŃCZONE<?php endif ?>
      </td>
      <td><?php echo escape($value['hash']); ?></td>
      <td>
        <?php echo Helper::linkTo('?usun='. escape($value['id']).'&token='. $token, 'usun') ?> |
        <?php echo Helper::linkTo('?edytuj='. escape($value['id']), 'edytuj') ?>
      </td>
    </tr>  
    <?php $x++; ?>   
    <?php endforeach ?>


    <?php else: ?>
     <tr>
      <th scope="row">-</th>
      <td>Brak</td>
      <td>Brak</td>
      <td>Brak</td>
      <td>Brak</td>
      <td>Brak
      <td>Brak</td>
    </tr>  
    <?php endif ?>
  </tbody>
</table>

























<?php endif ?>



























<?php 
if (isset($errors)) {
  pA($errors);
} ?> 

</div>



<script src="<?php echo $url ?>js/main.js"></script>
