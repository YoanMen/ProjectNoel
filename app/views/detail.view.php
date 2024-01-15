<!-- 
  $gift pour récupéré le cadeau
 -->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    <?= $gift['name']; ?> -
    <?= APP_NAME ?>
  </title>

  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/error.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/global.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/section/detail.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/main/main-detail.css">

  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/nav/menu.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/footer/footer.css">

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>

  <?php require_once '../app/views/templates/menu.php'; ?>

  <main class='main-detail'>
    <section class='detail'>
      <img class='detail__img' src=<?= ROOT . '/' . $gift['image_path'] ?> alt="">
      <div class='detail__container  white-background'>
        <div>
          <h3>
            <?= $gift['name']; ?>
          </h3>

          <?php if ($gift['recommended_age'] != 0) { ?>
            <span>
              A partir de
              <?= $gift['recommended_age']; ?> ans
            </span>
          <?php } ?>

        </div>
        <p>
          <?= $gift['description']; ?>
        </p>
        <div>
          <?php if (isset($_SESSION['gifts']) && in_array($gift['id'], $_SESSION['gifts'])) { ?>
            <button class="button button--red button--expanded js-button-letter "
              onclick='removeGift({id : <?= $gift["id"] ?> , button : this })'>Retirer
              de ma
              lettre</button>
          <?php } else { ?>
            <button class="button button--expanded js-button-letter"
              onclick='addGift( {id : <?= $gift["id"] ?> , button : this })'>Ajouter à ma
              lettre</button>
          <?php } ?>
        </div>
      </div>
    </section>
  </main>



  <?php require_once '../app/views/templates/footer.php'; ?>

  <script src='<?= ROOT ?>/assets/js/ajax/gift-to-letter.js'></script>

</body>

</html>