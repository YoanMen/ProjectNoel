<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ma lettre -
    <?= APP_NAME ?>
  </title>
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/global.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/nav/menu.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/header/instruction.css">

  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/main/main-letter.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/footer/footer.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/modal.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/message.css">

  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/section/letter-container.css">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>


  <?php
  require_once '../app/views/templates/menu.php';
  ?>


  <main class='main-letter'>
    <header class='instruction  white-background'>
      <p>Bienvenue sur la page de création de ta lettre magique, ici tu va remplir ta lettre avec les cadeaux que tu as
        séléctionner dans la salle aux cadeaux ou tu peux en faire la recherche ici.
      </p>
      <br>
      <p>Si tu n'as pas trouvé le cadeaux que tu cherché, tu peu en faire la demande ici et l'ajouter à ta lettre,
        si les lutins valide ton cadeau il sera ajouté à la salle aux cadeaux. </p>
      <form class='instruction__search' method='POST'>
        <input required class="search-input input--grey js-wanted-gift" type="text" name='wanted_gift'>
        <button class="button button--expanded" onclick='addWantedGift()'>Ajouter ce cadeau</button>
      </form>

    </header>



    <dialog class="js-modal border radius modal ">
      <span class="modal__close js-modal__close">&times;</span>
      <div class='js-modal__content'>

      </div>
    </dialog>

    <section class='letter-container border'>
      <form method="POST" class='js-letter__form'>
        <div class="letter-container__fieldset">

          <div>
            <h2>Bonjour Père Noel, </h2>
            <br>
            <br>
            <label class="letter-container_text">Je m'appelle <input required class="letter-container__input"
                type="text" name="" id="">
            </label>
            <label class="letter-container_text"> mon Nom de famille est <input required class="letter-container__input"
                type="text" name="" id=""> </label>
            <label class="letter-container_text"> et j'ai <input required class="letter-container__input" type="text"
                name="age"> ans. </label>
            <br>
            <label class="letter-container_text">J'habite à l'adresse <input required
                class="letter-container__input--adress letter-container__input" type="text" name="" id="">. </label>
          </div>
          <fieldset>
            <legend class="letter-container__legend letter-container_text">Cette année j'ai été :</legend>
            <label for="hight" class="letter-container__checkbox letter-container_text">
              Très sage !
              <input class="js-checkbox" type="checkbox" name="hight" id="hight">
            </label>
            <label for="middle" class="letter-container__checkbox letter-container_text">
              Sage
              <input class="js-checkbox" type="checkbox" name="middle" id="middle">
            </label>
            <label for="low" class="letter-container__checkbox letter-container_text">
              Un peu sage
              <input class="js-checkbox" type="checkbox" name="low" id="low">
            </label>
          </fieldset>
        </div>

        <br />
        <p class="letter-container_text">Ma liste de cadeaux :</p>

        <div class="letter-container__gift-container border js-letter ">


        </div>

        <button class='letter-container__validate-letter button button--red'>Valider ma lettre</button>
      </form>


    </section>
  </main>


  <?php require_once '../app/views/templates/footer.php'; ?>

  <script src="<?= ROOT ?>/assets/js/modals/letter-modal.js"></script>
  <script src="<?= ROOT ?>/assets/js/letter.js"></script>
</body>

</html>