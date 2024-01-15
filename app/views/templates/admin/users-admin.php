<h1 class='main-admin__title'>
  Gestion des utilisateurs
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
    <input type="search" name="search" id="" class='search-input search-input--grey' placeholder="nom d'utilisateur"
      value='<?= $pageState["search"] ?>'>
    <input type="submit" id="" class='button' value='rechercher'>
  </form>

  <button class="button button--expanded js-open-modal" onclick="openModal()">Ajouter</button>

  <?php if (!empty($users)) { ?>


    <table class=' admin-manage__table'>
      <thead>
        <tr>
          <th scope="col1">nom d'utilisateur</th>
          <th scope="col2">mot de passe</th>
        </tr>
      </thead>
      <tbody>

        <?php

        foreach ($users as $user) { ?>
          <tr>
            <td class='admin-manage__item '>
              <?= $user['username'] ?>
            </td>
            <td class='admin-manage__item'>
              <?= $user['password'] ?>
            </td>
            <td class='admin-manage__item '>
              <button class=" button button--red"
                onclick="openModal({type: 'remove', user: <?= htmlspecialchars(json_encode($user), ENT_QUOTES, 'UTF-8'); ?> } )">supprimer</button>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  <?php } ?>



  <nav class="pagination" aria-label="pagination">
    <a class='rounded__button   <?= ($pageState['currentPage'] <= 1) ? 'rounded__button--disable' : ''; ?>  '
      href="<?= ROOT ?>/admin/user?page=<?= $pageState['currentPage'] - 1 ?>&search=<?= $pageState['search'] ?>">
      <button>
        <img src="<?= ROOT ?>/assets/images/arrow.svg" alt="arrow left" class='arrow--flip arrow'>
      </button>
    </a>

    <ul class="pagination__list">
      <?php
      for ($i = 1; $i <= $totalPages; $i++) { ?>
        <li class="page-item  <?= ($pageState['currentPage'] == $i) ? "page-item--active" : "" ?>">
          <a href="<?= ROOT ?>/admin/user?page=<?= $i ?>&search=<?= $pageState['search'] ?>">
            <?= $i ?>
          </a>
        </li>
      <?php } ?>
    </ul>

    <a class='rounded__button <?= ($totalPages <= $pageState['currentPage']) ? 'rounded__button--disable' : ''; ?>  '
      href="<?= ROOT ?>/admin/user?page=<?= $pageState['currentPage'] + 1 ?>&search=<?= $pageState['search'] ?>">
      <button>
        <img src="<?= ROOT ?>/assets/images/arrow.svg" alt="arrow right" class="arrow "></button>
    </a>
  </nav>

</section>