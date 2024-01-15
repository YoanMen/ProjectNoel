let WANTED_GIFTS;
let GIFTS;
const FORM_LETTER = document.querySelector('.js-letter__form')
const CONTAINER = document.querySelector('.js-letter');
const CONTENT = document.querySelector('.js-modal__content');
const CLOSE = document.querySelector('.js-modal__close');
const MODAL = document.querySelector('.js-modal');
const SEARCH_FORM = document.querySelector('.instruction__search');
const CHECKBOX = document.querySelectorAll('.js-checkbox');

document.addEventListener("DOMContentLoaded", () => {

  loadGifts();

  CLOSE.addEventListener('click', () => {
    MODAL.close();
  })


  CHECKBOX.forEach(element => {
    element.addEventListener('click', () => {
      let checkedName = element.name;

      CHECKBOX.forEach(element => {
        if (checkedName != element.name) {
          element.checked = false;
        }
      });
    })
  });


  FORM_LETTER.addEventListener("submit", (event) => {
    event.preventDefault();
    validateLetter();
  })
})


function addWantedGift() {
  const WANTED_GIFT = document.querySelector('.js-wanted-gift');
  const ERROR = document.querySelector('.error');

  SEARCH_FORM.addEventListener('submit', (event) => {
    event.preventDefault();
  })

  $.ajax({
    type: "POST",
    url: "letter/addWantedGift",
    data: {
      wanted_gift:
        WANTED_GIFT.value
    },
    dataType: "json",
    success: function (response) {
      switch (response['status']) {
        case 'sucess':
          WANTED_GIFT.value = '';
          loadGifts();


          if (ERROR != null) {
            ERROR.remove();
          }

          break;

        case 'error':



          if (ERROR == null) {
            var errorDiv = document.createElement('div');
            errorDiv.className = 'error';

            var paragraph = document.createElement('p');
            paragraph.textContent = response['message'];

            errorDiv.appendChild(paragraph);


            SEARCH_FORM.appendChild(errorDiv);
          } else {
            ERROR.innerHTML = `<p>${response['message']}</p>`;
          }


          break;
      }
    }
  });

}


function removeWantedGift(name) {

  CONTENT.innerHTML = `<h3 class='modal__title'>Supprimer le cadeau</h3>
  <button class="js-modal-confirm  button button--expanded button--red"
    onclick="confirmDelete({name: '${name}'})">supprimer</button>`

  MODAL.showModal();
}




function removeGift({ id = null }) {

  CONTENT.innerHTML = `<h3 class='modal__title'>Supprimer le cadeau</h3>
  <button class="js-modal-confirm  button button--expanded button--red"
    onclick="confirmDelete({id : ${id}})">supprimer</button>`

  MODAL.showModal();
}


function confirmDelete({ id = null, name = null }) {
  $.ajax({
    type: "POST",
    url: (id != null) ? "removeGiftfromLetter" : 'removeWantedGiftfromLetter',
    data: { id: id, name: name },
    dataType: "json",
    success: function (response) {
      switch (response['status']) {
        case 'sucess':
          MODAL.close();
          loadGifts();
          break;

        case 'error':

          break;
      }
    }
  });
}



function initialiseGifts({ gifts = null, wanted_gifts = null }) {
  let giftsList = '';
  gifts.forEach(gift => {
    giftsList += ` <div class='letter-container__gift'>
    <button onclick="removeGift( {id: ${gift['id']}})" type="button" class='letter-container__gift--button'>
    ${gift['name']}
    </button>
  </div>`
  });


  if (wanted_gifts != null) {
    wanted_gifts.forEach(gift => {
      giftsList += ` <div class='letter-container__gift'>
      <button onclick="removeWantedGift('${gift['name']}')" type="button" class='letter-container__gift--button'>
      ${gift['name']}
      </button>
    </div>`
    });
  }


  CONTAINER.innerHTML = giftsList;
}



function loadGifts() {
  $.ajax({
    type: "POST",
    url: "letter/loadGifts",
    dataType: "json",
    success: function (response) {
      switch (response['status']) {
        case 'sucess':

          initialiseGifts({ gifts: response['gifts'], wanted_gifts: response['wanted_gifts'] });

          WANTED_GIFTS = response['wanted_gifts'];
          GIFTS = response['gifts'];
          break;

        case 'error':
          break;
      }
    }
  });
}


function validateLetter() {

  const ERROR = document.querySelector('.error');
  let emptyCheckbox = true;
  let sage;

  CHECKBOX.forEach(element => {
    if (element.checked == true) {
      sage = element.name;
      emptyCheckbox = false;
    }
  });


  if (CONTAINER.hasChildNodes() && !emptyCheckbox) {
    if (ERROR != null) {
      ERROR.remove();
    }

    const name = document.getElementById('name').value;
    const username = document.getElementById('username').value;
    const age = document.getElementById('age').value;

    $.ajax({
      type: "POST",
      url: "letter/send",
      data: { name: name, username: username, age: age, wanted_gift: WANTED_GIFTS, gifts: GIFTS },
      dataType: "json",
      success: function (response) {

      }
    });


    console.log('Good validation')


  } else {

    if (ERROR == null) {
      var errorDiv = document.createElement('div');
      errorDiv.className = 'error';

      var paragraph = document.createElement('p');
      (emptyCheckbox) ? paragraph.textContent = 'Il faut séléctionner son degrès de sagesse' : paragraph.textContent = 'La liste est vide';

      errorDiv.appendChild(paragraph);


      SEARCH_FORM.appendChild(errorDiv);
    } else {

      (emptyCheckbox) ? ERROR.innerHTML = `<p>Il faut séléctionner son degrès de sagesse</p>` : ERROR.innerHTML = `<p>La liste est vide</p>`;
    }
  }
}