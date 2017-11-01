<?php use MyApp\Tpl\Helper as Helper;?>
<!doctype html>

<html lang="<?= escape($lang);?>">
    <head>


      <title><?= escape($title); ?></title>
      <meta charset= "<?= escape($charset); ?>">
		  <link rel="stylesheet" href="<?php echo $url ?>css/main.css">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    </head>

    <body>
        <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <div class="container">

          <a class="navbar-brand" href="<?php echo $url ?>index.php">
            <img src="<?php echo $url ?>img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
            Skryptuj
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">

              <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
              </li>
              <?php if (!$user): ?>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo $url; ?>login.php">Logowanie</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo $url; ?>register.php">Rejestracja</a>
                </li>
              <?php endif ?>
              <li class="nav-item">
                <a class="nav-link" href="#">Kontakt</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">FAQ</a>
              </li>


              <?php if ($user): ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?php echo $user['username']; ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="<?php echo $url ?>page.php">Moj profil</a>
                  <a class="dropdown-item" href="<?php echo $url ?>update.php">Edytuj konto</a>
                  <a class="dropdown-item" href="<?php echo $url ?>orders.php">Moje zamówienia</a>

                  <div class="dropdown-divider"></div>
                  <?php if ($user['permission'] == 1): ?>
                  <a class="dropdown-item" href="<?php echo $url; ?>admin/index.php">Panel Administratora</a>
                  <?php endif ?>
                  <a class="dropdown-item" href="<?php echo $url; ?>logout.php">Wyloguj</a>
                </div>
              </li>
              <?php endif ?>
            </ul>

          </div>
            </div>
        </nav>