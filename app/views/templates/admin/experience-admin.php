<h1 class='main-admin__title'>
  Gestion des expériences
</h1>


<?php
require '../app/views/templates/message.php';

?>

<section class='admin-manage '>


  <dialog class="js-modal border radius modal ">
    <span class="modal__close js-modal__close">&times;</span>
    <div class='js-modal__content'></div>


  </dialog>





  <?php if (!empty($experiences)) { ?>


    <table class=' admin-manage__table'>
      <thead>
        <tr>
          <th scope="col1">speudo</th>
          <th scope="col2">expérience</th>
          <th scope="col3">état</th>

        </tr>
      </thead>
      <tbody>

        <?php

        foreach ($experiences as $experience) { ?>
          <tr>
            <td class='admin-manage__item '>
              <?= $experience['speudo'] ?>
            </td>
            <td class='admin-manage__item'>
              <?= $experience['description'] ?>
            </td>
            <td class='admin-manage__item'>
              <?php if ($experience['validate'] == 1) { ?>
                <strong> VALIDER </strong>
              <?php } else { ?>
                NON VALIDER
              <?php } ?>
            </td>
            <td class='admin-manage__item '>
              <button class=" button "
                onclick="openModal({type: 'see', experience: <?= htmlspecialchars(json_encode($experience), ENT_QUOTES, 'UTF-8'); ?> } )">voir</button>

            </td>
            <td class='admin-manage__item '>
              <button class=" button button--red"
                onclick="openModal({type: 'remove', experience: <?= htmlspecialchars(json_encode($experience), ENT_QUOTES, 'UTF-8'); ?> } )">supprimer</button>

            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  <?php } else { ?>
    <div class='alert'>
      <p>Aucune expériences</p>
    </div>
  <?php } ?>



  <nav class="pagination" aria-label="pagination">
    <a class='rounded__button   <?= ($pageState['currentPage'] <= 1) ? 'rounded__button--disable' : ''; ?>  '
      href="<?= ROOT ?>/admin/experience?page=<?= $pageState['currentPage'] - 1 ?>">
      <button>
        <img src="<?= ROOT ?>/assets/images/arrow.svg" alt="arrow left" class='arrow--flip arrow'>
      </button>
    </a>

    <ul class="pagination__list">
      <?php
      for ($i = 1; $i <= $totalPages; $i++) { ?>
        <li class="page-item  <?= ($pageState['currentPage'] == $i) ? "page-item--active" : "" ?>">
          <a href="<?= ROOT ?>/admin/experience?page=<?= $i ?>">
            <?= $i ?>
          </a>
        </li>
      <?php } ?>
    </ul>

    <a class='rounded__button <?= ($totalPages <= $pageState['currentPage']) ? 'rounded__button--disable' : ''; ?>  '
      href="<?= ROOT ?>/admin/experience?page=<?= $pageState['currentPage'] + 1 ?>  ">
      <button>
        <img src="<?= ROOT ?>/assets/images/arrow.svg" alt="arrow right" class="arrow "></button>
    </a>
  </nav>

</section>