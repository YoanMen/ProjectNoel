<h1 class='main-admin__title'>
  Gestion des cadeaux
</h1>



<?php
require '../app/views/templates/message.php';

?>

<section class='admin-manage '>



  <dialog class="js-modal border radius modal ">
    <span class="modal__close js-modal__close">&times;</span>
    <div class='js-modal__content'></div>
  </dialog>




  <form action="" class='admin-manage__search'>
    <input type="search" name="search" id="" class='search-input search-input--grey' placeholder="nom du cadeau"
      value='<?= $pageState["search"] ?>'>
    <input type="submit" id="" class='button' value='rechercher'>
  </form>

  <button class="button button--expanded"
    onclick="openModal({  categorys: <?= htmlspecialchars(json_encode($categorys), ENT_QUOTES, 'UTF-8'); ?>  } )">Ajouter</button>

  <?php if (!empty($gifts)) { ?>


    <table class='admin-manage__table'>
      <thead>
        <tr>
          <th scope="col1">nom </th>
          <th scope="col2">description</th>
          <th scope="col3">catégorie</th>
          <th scope="col4">age recommandé</th>


        </tr>
      </thead>
      <tbody>

        <?php



        foreach ($gifts as $gift) { ?>
          <tr>
            <td class='admin-manage__item  '>
              <?= $gift['name'] ?>
            </td>
            <td class='admin-manage__item    '>
              <?= $gift['description'] ?>
            </td>
            <td class='admin-manage__item  '>
              <?= $gift['category_name'] ?>
            </td>
            <td class='admin-manage__item  '>
              <?= $gift['recommended_age'] ?>
            </td>

            <td class='admin-manage__item admin-manage__item--wrap '>
              <button class="button"
                onclick="openModal({type: 'edit', gift: <?= htmlspecialchars(json_encode($gift), ENT_QUOTES, 'UTF-8'); ?>,  categorys: <?= htmlspecialchars(json_encode($categorys), ENT_QUOTES, 'UTF-8'); ?> } )">modifier</button>
            </td>
            <td class='admin-manage__item  admin-manage__item--wrap  '>
              <button class=" button button--red"
                onclick="openModal({type: 'remove', gift: <?= htmlspecialchars(json_encode($gift), ENT_QUOTES, 'UTF-8'); ?> } )">supprimer</button>
            </td>
          </tr>
        <?php }

        ?>

      </tbody>
    </table>
  <?php } ?>



  <nav class=" pagination" aria-label="pagination">
    <a class='rounded__button   <?= ($pageState['currentPage'] <= 1) ? 'rounded__button--disable' : ''; ?>  '
      href="<?= ROOT ?>/admin/gift?page=<?= $pageState['currentPage'] - 1 ?>&search=<?= $pageState['search'] ?>">
      <button>
        <img src="<?= ROOT ?>/assets/images/arrow.svg" alt="arrow left" class='arrow--flip arrow'>
      </button>
    </a>

    <ul class="pagination__list">
      <?php
      for ($i = 1; $i <= $totalPages; $i++) { ?>
        <li class="page-item  <?= ($pageState['currentPage'] == $i) ? "page-item--active" : "" ?>">
          <a href="<?= ROOT ?>/admin/gift?page=<?= $i ?>&search=<?= $pageState['search'] ?>">
            <?= $i ?>
          </a>
        </li>
      <?php } ?>
    </ul>

    <a class='rounded__button <?= ($totalPages <= $pageState['currentPage']) ? 'rounded__button--disable' : ''; ?>  '
      href="<?= ROOT ?>/admin/gift?page=<?= $pageState['currentPage'] + 1 ?>&search=<?= $pageState['search'] ?>">
      <button>
        <img src="<?= ROOT ?>/assets/images/arrow.svg" alt="arrow right" class="arrow "></button>
    </a>
  </nav>

</section>