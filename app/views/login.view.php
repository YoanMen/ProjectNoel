<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion -
    <?= APP_NAME ?>
  </title>

  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/nav/menu.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/footer/footer.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/section/connection.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/message.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/global.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/footer/footer.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/nav/menu.css">


  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>

  <?php require_once '../app/views/templates/menu.php'; ?>

  <main>

    <section class='connection'>
      <form class='connection__form  white-background radius border' method="post" id="form-login">
        <h3 class='connection__title'>Connexion</h3>
        <div class='connection__avatar'>
          <img src=" <?= ROOT ?>/assets/images/pere_noel.svg" alt="website logo representing elfe and Santa Claus"
            height="64px">
          <img src="<?= ROOT ?>/assets/images/elfe.svg" alt="website logo representing elfe and Santa Claus"
            height="64px">
        </div>
        <div>
          <h4>Nom du compte</h4>
          <input class='text-input input--grey' placeholder="nom du compte" type="text" name="username"
            id='input-username' required>
        </div>
        <div>
          <h4>Mot de passe</h4>
          <input class='text-input  input--grey ' placeholder="mot de passe" type="password" name="password"
            id='input-password' required>
        </div>


        <?php
        require '../app/views/templates/message.php';
        ?>
        <input class='button button--expanded js-login-button' type="submit" value="Connection" id="button-submit">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
      </form>

  </main>


  <?php require_once '../app/views/templates/footer.php'; ?>

  <script>    var csrf_token = "<?php echo $_SESSION['csrf_token']; ?>";
  </script>
  <script src="<?= ROOT ?>/assets/js/ajax/login.js"></script>
</body>

</html>