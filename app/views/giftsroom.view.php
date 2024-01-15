<!-- 
  $gifts pour récupéré liste cadeaux
  
 -->


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Salle au cadeaux -
    <?= APP_NAME ?>
  </title>



  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/section/connection.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/error.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/global.css">

  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/nav/menu.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/footer/footer.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/section/gifts-content.css">

  <script src="<?= ROOT ?>/assets/js/scroll-position.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>


  <?php require_once '../app/views/templates/menu.php'; ?>

  <main>

    <section class='gifts-content'>
      <form class='gifts-content__search white-background border' action="  <?= ROOT . '/giftsroom' ?> " method="get">
        <label class="search__label" for=""> Recherche par Nom</label>
        <input class='search-input input--grey' type="search" name="search" id="" value='<?= $pageState['search'] ?>'>
        <label class="search__label" for=""> Recherche par Catégorie</label>
        <select class="select-input" name="category" id="category">
          <option value='all'>Toutes les catégories</option>
          <?php
          foreach ($categorys as $category) { ?>
            <option value="<?= $category["name"] ?>" <?= ($category["name"] == $pageState['category']) ? 'selected' : ''; ?>>
              <?= $category["name"] ?>
            </option>
          <?php } ?>
        </select>
        <label class="search__label" for=""> Triée par</label>
        <select class="select-input" name="order" id="age">
          <option value="new" <?= ('new' == $pageState['order']) ? 'selected' : ''; ?>>Nouveau
            cadeaux</option>
          <option value="desc" <?= ('desc' == $pageState['order']) ? 'selected' : ''; ?>>Age
            décroissant</option>
          <option value="asc" <?= ('asc' == $pageState['order']) ? 'selected' : ''; ?>>Age
            croissant</option>
        </select>
        <input class="search__button button button--expanded" type="submit" value="Rechercher">
      </form>

      <article class='gifts-content__container '>
        <?php if (empty($gifts)) { ?>
          <p class='gifts-content__empty'>Aucun résultat trouvé</p>
        <?php } else {

          foreach ($gifts as $gift) { ?>
            <article class='gifts-content__item background__white'>
              <label class="gifts-content__name ">
                <?= $gift['name'] ?>
              </label>
              <a href="<?= ROOT ?>/giftsroom/detail/<?= $gift['id'] ?> ">
                <img class="gifts-content__img" src=<?= ROOT . '/' . $gift['image_path'] ?> alt="">
              </a>
              <div>
                <?php if (isset($_SESSION['gifts']) && in_array($gift['id'], $_SESSION['gifts'])) { ?>
                  <button class="button button--expanded button--red  js-button-letter"
                    onclick='removeGift({id : <?= $gift["id"] ?> , button : this})'>Retirer
                    de ma
                    lettre</button>
                <?php } else { ?>
                  <button class="button  button--expanded js-button-letter"
                    onclick='addGift( {id : <?= $gift["id"] ?> , button : this })'>Ajouter à ma
                    lettre</button>
                <?php } ?>
              </div>


            </article>
          <?php }
        } ?>
      </article>

    </section>



  </main>
  <nav class="pagination" aria-label="pagination">
    <a class='rounded__button   <?= ($pageState['currentPage'] <= 1) ? 'rounded__button--disable' : ''; ?>  '
      href="<?= ROOT ?>/giftsroom?page=<?= $pageState['currentPage'] - 1 ?>&search=<?= $pageState['search'] ?>&category=<?= $pageState['category'] ?>&order=<?= $pageState['order'] ?>">
      <button>
        <img src="<?= ROOT ?>/assets/images/arrow.svg" alt="arrow left" class='arrow--flip arrow'>
      </button>
    </a>

    <ul class="pagination__list">
      <?php
      for ($i = 1; $i <= $totalPages; $i++) { ?>
        <li class="page-item  <?= ($pageState['currentPage'] == $i) ? "page-item--active" : "" ?>">
          <a
            href="<?= ROOT ?>/giftsroom?page=<?= $i ?>&search=<?= $pageState['search'] ?>&category=<?= $pageState['category'] ?>&order=<?= $pageState['order'] ?>">
            <?= $i ?>
          </a>
        </li>
      <?php } ?>
    </ul>

    <a class='rounded__button <?= ($totalPages <= $pageState['currentPage']) ? 'rounded__button--disable' : ''; ?>  '
      href="<?= ROOT ?>/giftsroom?page=<?= $pageState['currentPage'] + 1 ?>&search=<?= $pageState['search'] ?>&category=<?= $pageState['category'] ?>&order=<?= $pageState['order'] ?>">
      <button>
        <img src="<?= ROOT ?>/assets/images/arrow.svg" alt="arrow right" class="arrow "></button>
    </a>
  </nav>

  <?php require_once '../app/views/templates/footer.php'; ?>
  <script src='<?= ROOT ?>/assets/js/ajax/gift-to-letter.js'></script>

</body>

</html>