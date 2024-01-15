<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administration -
    <?= APP_NAME ?>
  </title>

  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/divider.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/message.css">


  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/modal.css">

  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/global.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/footer/footer.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/nav/menu.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/aside/admin-menu.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/main/main-admin.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/section/admin-manage.css">

  <script src="<?= ROOT ?>/assets/js/scroll-position.js"></script>
</head>

<body>

  <?php require_once '../app/views/templates/menu.php' ?>


  <!-- DASHBOARD menu -->
  <aside class='admin-menu'>
    <p>Bonjour
      <?= $_SESSION['USER']['username'] ?> !
    </p>
    <h2 class='admin-menu__title'>Dashboard</h2>
    <hr />


    <ul class='admin-menu__list'>

      <?php if ($_SESSION['USER']['role'] == 'admin') { ?>
        <li>
          <a class='admin-menu__item <?= ($pageState['dashboard'] == 'user') ? 'admin-menu__item--active' : '' ?> '
            href="<?= ROOT ?>/admin/user">Utilisateurs</a>
        </li>
      <?php } ?>
      <li>
        <a class='admin-menu__item  <?= ($pageState['dashboard'] == 'gift') ? 'admin-menu__item--active' : '' ?> '
          href="<?= ROOT ?>/admin/gift">Cadeaux</a>
      </li>
      <li>
        <a class='admin-menu__item  <?= ($pageState['dashboard'] == 'experience') ? 'admin-menu__item--active' : '' ?> '
          href="<?= ROOT ?>/admin/experience">Expériences</a>
      </li>
      <li>
        <a class='admin-menu__item  <?= ($pageState['dashboard'] == 'letter') ? 'admin-menu__item--active' : '' ?> '
          href="">Lettres</a>
      </li>
    </ul>
  </aside>
  <!-- DASHBOARD END -->




  <!-- Display selected page -->
  <main class='main-admin'>
    <?php


    switch ($pageState['dashboard']) {
      case 'user':
        require '../app/views/templates/admin/users-admin.php';

        break;
      case 'gift':
        require '../app/views/templates/admin/gifts-admin.php';
        break;
      case 'experience':
        require '../app/views/templates/admin/experience-admin.php';
        break;
      case 'letter':
        require '../app/views/templates/admin/gift.php';
        break;

    }


    ?>
  </main>
  <!-- Display selected page END -->

  <?php require_once '../app/views/templates/footer.php' ?>







  <?php
  switch ($pageState['dashboard']) {
    case 'user':
      ?>
      <script src="<?= ROOT ?>/assets/js/modals/modal-user.js"></script>
      <script src="<?= ROOT ?>/assets/js/password-valid.js"></script>
      <?php
      break;
    case 'gift':
      ?>
      <script src="<?= ROOT ?>/assets/js/modals/modal-gift.js"></script>
      <?php
      break;
    case 'experience':
      ?>
      <script src="<?= ROOT ?>/assets/js/modals/modal-experience.js"></script>
      <?php
      break;
    case 'letter':
      break;

  }
  ?>

  <script>
    var csrf_token = "<?php echo $_SESSION['csrf_token']; ?>";
    var maxFileSize = <?= MAX_FILE_SIZE ?>;
  </script>
</body>

</html>