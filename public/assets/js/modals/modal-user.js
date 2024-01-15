
const MODAL = document.querySelector('.js-modal');
const CLOSE = document.querySelector('.js-modal__close');
const MODAL_CONTENT = document.querySelector('.js-modal__content');

document.addEventListener("DOMContentLoaded", function (event) {

  CLOSE.addEventListener("click", function () {
    MODAL.close();
  })
});




function openModal({ type = 'add', user = null, } = {}) {



  switch (type) {


    case 'remove':
      MODAL_CONTENT.innerHTML = `
      <h3 class='modal__title'>Supprimer l'utilisateur</h3>
      <form class="modal__form" method="POST" action='user/remove/${user.id}'>
        <button class="js-close-modal button button--expanded button--red" type='submit'>supprimer</button>
        <input type="hidden" name="csrf_token" value="${csrf_token}">
      </form>
      
      `;
      MODAL.showModal();
      break;

    default:

      MODAL_CONTENT.innerHTML = `
      <h3 class='modal__title'>Ajouter un utilisateur</h3>
      <form class="modal__form" method="POST" action='user/add'>
        <input required type="text" name="username" placeholder="nom d'utilisateur" class="text-input input--grey">
        <input required type=" text" name="password" placeholder="mot de passe" class="text-input input--grey js-password">
        <button class="button button--expanded" type='submit' id='submitUser'>Ajouter</button>
        <input type="hidden" name="csrf_token" value="${csrf_token}">
      </form>
      `;
      MODAL.showModal();
      passwordValid();

  }

}