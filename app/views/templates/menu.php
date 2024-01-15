<nav class='menu'>


  <a href="<?= ROOT; ?>/"><img src="<?= ROOT ?>/assets/images/logo.svg"
      alt="website logo representing elfe and Santa Claus" height="64px">
  </a>
  <ul class='menu__list '>
    <li class='menu__item <?= $pageState['menu'] == 'home' ? ' menu__item--active' : '' ?>'>
      <a href="<?= ROOT; ?>/">accueil enchanté</a>
      <div></div>
    </li>
    <li class='menu__item <?= $pageState['menu'] == 'gift' ? ' menu__item--active' : '' ?>'>
      <a href="<?= ROOT; ?>/giftsroom">salle aux cadeaux</a>
      <div></div>
    </li>
    <?php if (!isset($_SESSION['USER'])) { ?>
      <li class='menu__item <?= $pageState['menu'] == 'login' ? ' menu__item--active' : '' ?>'>
        <a href="<?= ROOT; ?>/login">connexion magique</a>
        <div></div>
      </li>
    <?php } else { ?>
      <li class='menu__item <?= $pageState['menu'] == 'admin' ? ' menu__item--active' : '' ?>'>
        <a href="<?= ROOT; ?>/admin">menu magique</a>
        <div></div>
      </li>
      <li class='menu__item '>
        <a href="<?= ROOT; ?>/logout">se déconnecter</a>
        <div></div>
      </li>
    <?php } ?>
    <li class='menu__item <?= $pageState['menu'] == 'contact' ? ' menu__item--active' : '' ?>'>
      <a href="<?= ROOT; ?>/contact">contact</a>
      <div></div>
    </li>

  </ul>

</nav>