
const MODAL = document.querySelector('.js-modal');
const CLOSE = document.querySelector('.js-modal__close');
const MODAL_CONTENT = document.querySelector('.js-modal__content');

document.addEventListener("DOMContentLoaded", function (event) {

  CLOSE.addEventListener("click", function () {
    MODAL.close();
  })
});




function openModal({ type = 'add', gift = null, categorys = null }) {


  function generateCategoryOptions(selectedCategory = null) {
    let options;
    categorys.forEach(category => {
      options += `<option value="${category.id}" ${category.name === selectedCategory ? 'selected' : ''}>
        ${category.name}
      </option>`;
    });

    return options;
  }

  console.log(gift);
  switch (type) {

    case 'edit':
      MODAL_CONTENT.innerHTML = `
      <h3 class='modal__title'>Modifier un cadeau</h3>
    
      <form  enctype="multipart/form-data" class="modal__form" method="POST" action='gift/edit/${gift.id}'>
        <input required type="text" name="name" placeholder="Nom du cadeau" class="text-input input--grey" value="${gift.name}">
        <select class="select-input" name="category" id="category">
          ${generateCategoryOptions(gift.category_name)}
        </select>
        <input  required type="number" name="age" placeholder="age recommandé" name="age" class="text-input input--grey" value="${gift.recommended_age}">
        <div class='modal__file-consigne'>
        <p>Format accepté "png", "jpeg", "jpg"</p>
        <p>La taille de l'image ne doit pas dépasser 8mo</p>
        </div>
        <!-- MAX_FILE_SIZE doit précéder le champ de saisie du fichier -->
        <input type="hidden" name="MAX_FILE_SIZE" value="${maxFileSize}" />
        <input name='file' type="file" name="image"  class="file-input" accept="image/png, image/jpeg, image/jpg" >
        <textarea maxlength="450" required class='text-area input--grey' placeholder="Description" name="description" id="desc" cols="30" rows="10"> ${gift.description}</textarea>
        <button class="js-close-modal button button--expanded" type='submit'>Modifier</button>
        <input type="hidden" name="csrf_token" value="${csrf_token}">
      </form>
    `;

      MODAL.showModal();
      break;

    case 'remove':
      MODAL_CONTENT.innerHTML = `
      <h3 class='modal__title'>Supprimer le cadeau</h3>
      <form class="modal__form" method="POST" action='gift/remove/${gift.id}'>
        <button class="js-close-modal button button--expanded button--red" type='submit'>supprimer</button>
        <input type="hidden" name="csrf_token" value="${csrf_token}">
      </form>
      
      `;
      MODAL.showModal();
      break;

    default:

      MODAL_CONTENT.innerHTML = `
      <h3 class='modal__title'>Ajouter un cadeau</h3>
      
      <form enctype="multipart/form-data" class="modal__form" method="POST" action='gift/add'>
        <input required type="text" name="name" placeholder="nom du cadeau" class="text-input input--grey">
        <select class="select-input" name="category" id="category">
        ${generateCategoryOptions()}
        </select>
        <input required type="number=" password" placeholder="age recommandé" name="age" class="text-input input--grey">
        <div class='modal__file-consigne'>
        <p>Format accepté "png", "jpeg", "jpg"</p>
        <p>La taille de l'image ne doit pas dépasser 8mo</p>
        </div>
        <input type="hidden" name="MAX_FILE_SIZE" value="${maxFileSize}" />
        <input required type="file" name="file"  class="file-input" accept="image/png, image/jpeg" >
        <textarea maxlength="450" required class='text-area input--grey' placeholder="description" name="description"
          cols="30" rows="10"></textarea>
        <button class=" button button--expanded" type='submit' >Ajouter</button>
        <input type="hidden" name="csrf_token" value="${csrf_token}">
      </form>
    
      `;

      MODAL.showModal();
  }

}