<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accueil enchanté -
    <?= APP_NAME ?>
  </title>


  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/header/hero.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/header/hero.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/section/experience.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/article/new-gifts.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/section/letter.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/divider.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/snow.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/message.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/aside/countdown.css">

  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/global.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/footer/footer.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/nav/menu.css">

  <script src="<?= ROOT ?>/assets/js/scroll-position.js"></script>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>



  <?php
  require_once '../app/views/templates/menu.php';
  ?>

  <main>



    <aside class='countdown'>
      <h3 class="countdown__title">Noel est dans</h3>

      <div class="countdown__counter">
        <div class='countdown__item'>
          <div class='countdown__box js-countdown--days'></div>
          <div>JOURS</div>
        </div>
        <div class='countdown__item'>
          <div class='countdown__box  js-countdown--hours'></div>
          <div>HEURES</div>
        </div>
        <div class='countdown__item'>
          <div class='countdown__box  js-countdown--minutes'></div>
          <div>MINUTES</div>
        </div>
        <div class='countdown__item  '>
          <div class='countdown__box js-countdown--seconds'></div>
          <div>SECONDES</div>
        </div>
      </div>

    </aside>



    <header class='hero'>
      <img class="hero__image" src="<?= ROOT ?>/assets/images/hero/renne.jpg" alt="">
      <div class='snow'></div>
      <h1 class='hero__title'>Le site du<br> <span>Père Noel</span></h1>
      <div class="hero__text">
        <div> <a class="button button--red" href="#letter">Soumettre ma lettre</a>
        </div>
        <p>"Noël, moment de partage et de joie, célèbre la naissance de l'esprit de générosité et
          d'amour."
        </p>
      </div>


    </header>

    <?php if (!empty($gifts)) { ?>
      <div class="divider">
        <img src="<?= ROOT ?>/assets/images/divider.svg" alt="">
      </div>


      <article class="new-gifts">

        <h2 class='new-gifts__title'>Les dernier cadeaux ajouté !</h2>

        <div class='new-gifts__scroll js-h-scroll-animation'>

          <?php foreach ($gifts as $gift) { ?>
            <article class='new-gifts__item'>
              <h3 class="new-gifts__name ">
                <?= $gift['name'] ?>
              </h3>
              <a href="<?= ROOT ?>/giftsroom/detail/<?= $gift['id'] ?> ">
                <img class="new-gifts__img" src=<?= ROOT . '/' . $gift['image_path'] ?> alt="">
              </a>
            </article>
          <?php } ?>

        </div>
      </article>
    <?php } ?>

    <div class="divider">
      <img src="<?= ROOT ?>/assets/images/divider.svg" alt="">
    </div>


    <section class='experience'>


      <h2 class='experience__title'>Les Expériences de Noel !</h2>

      <?php if (isset($experiences)) { ?>
        <div class='experience__row'>
          <a class='rounded__button js-keep-scroll  <?= ($currentPage == 1) ? 'rounded__button--disable' : ''; ?>  '
            href="<?= ROOT ?>?desc_page=<?= $currentPage - 1 ?>">
            <button>
              <img src="<?= ROOT ?>/assets/images/arrow.svg" alt="arrow left" class='arrow--flip arrow'>
            </button>
          </a>
          <article class='experience__container'>
            <?php foreach ($experiences as $experience) { ?>
              <article class='experience__item  white-background radius'>
                <h3>
                  <?= $experience['speudo']; ?>
                </h3>
                <p>
                  <?= $experience['description']; ?>
                </p>
              </article>
            <?php } ?>
          </article>
          <a class='rounded__button js-keep-scroll <?= ($currentPage >= $experiences['totalPages']) ? 'rounded__button--disable' : ''; ?>  '
            href="<?= ROOT ?>?desc_page=<?= $currentPage + 1 ?>">
            <button>
              <img src="<?= ROOT ?>/assets/images/arrow.svg" alt="arrow right" class="arrow "></button>
          </a>
        </div>

      <?php } ?>


      <div class='experience__form-container'>

        <div>
          <form id='form-experience' class=" experience__form white-background radius border " method="POST">
            <h3>Ton expérience</h3>
            <input id='speudo-input' required class='text-input js-desactive-send' placeholder="speudo" type="text"
              name="speudo" id="speudo">
            <textarea id='experience-input' maxlength="450" required class='text-area js-desactive-send'
              placeholder="description de l'expérience" name="experience" id="experience" cols="30"
              rows="10"></textarea>
            <input class="button button--expanded js-button-send" type="submit" value="Envoyer">


            <input id='csrf_token' type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
          </form>
          <p class='experience__message'>* L'expérience sera visible après validation par les elfes</p>
        </div>

        <img class='experience__image js-light-chrismas-tree' src="<?= ROOT ?>/assets/images/sapin.png" alt="">

      </div>
    </section>


    <div class="divider">
      <img src="<?= ROOT ?>/assets/images/divider.svg" alt="">
    </div>


    <section class="letter" id='letter'>
      <div>
        <h2 class='letter__title '>Fais ta Lettre Magique !</h2>
        <p class='white-background'>
          Découvrez la magie de la Salle aux Cadeaux pour trouver des trésors enchantés à ajouter à votre lettre magique
          au
          Père Noël. <br> <br>
          Cliquez sur 'Soumettre ma lettre' pour personnaliser votre liste de souhaits, écrire un message, et visualiser
          les
          cadeaux sélectionnés.
          Si vous ne trouvez pas le cadeau idéal, n'hésitez pas à le demander dans votre lettre magique !
        </p>
      </div>


      <a class="button button--red" href="<?= ROOT ?>/letter"> Soumettre ma
        lettre</a>

    </section>


  </main>


  <?php require_once '../app/views/templates/footer.php'; ?>

  <script src="<?= ROOT ?>/assets/js/ajax/send-experience.js"></script>
  <script src="<?= ROOT ?>/assets/js/h-scroll-animation.js"></script>
  <script src="<?= ROOT ?>/assets/js/countdown.js"></script>
  <script src="<?= ROOT ?>/assets/js/light-chrismas-tree.js"></script>
</body>

</html>