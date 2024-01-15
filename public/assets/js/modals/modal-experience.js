
const MODAL = document.querySelector('.js-modal');
const CLOSE = document.querySelector('.js-modal__close');
const MODAL_CONTENT = document.querySelector('.js-modal__content');

document.addEventListener("DOMContentLoaded", function (event) {

  CLOSE.addEventListener("click", function () {
    MODAL.close();
  })

});




function openModal({ type = 'see', experience = null }) {


  function setButtonAction() {

    if (experience.validate == 1) {
      return `<button class="button button--expanded button--red" type='submit'>Ne plus valider</button>`;
    }
    else {
      return `<button class="button button--expanded" type='submit'>Valider</button>`;

    }
  }

  switch (type) {

    case 'remove':
      MODAL_CONTENT.innerHTML = `
      <h3 class='modal__title'>Supprimer l'expérience</h3>
      <form class="modal__form" method="POST" action='experience/remove/${experience.id}'>
        <button class="js-close-modal button button--expanded button--red" type='submit'>supprimer</button>
        <input type="hidden" name="csrf_token" value="${csrf_token}">
      </form>
      
      `;
      MODAL.showModal();
      break;

    default:

      MODAL_CONTENT.innerHTML = `
      <h3 class='modal__title'>Gestion de la validation</h3>
      <h4>${experience.speudo}</h4>
      <br>
      <p >${experience.description}</p>
      <br>
      <form class="modal__form" method="POST" action='experience/validate/${experience.id}'>
      ${setButtonAction()}
        <input type="hidden" name="csrf_token" value="${csrf_token}">
      </form>
      
    
      `;

      MODAL.showModal();
  }

}