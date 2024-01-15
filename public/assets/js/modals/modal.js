
document.addEventListener("DOMContentLoaded", function (event) {


  const MODAL = document.querySelector('.js-modal');
  const CLOSE = document.querySelector('.js-close-modal');
  const OPEN = document.querySelector('.js-open-modal');




  OPEN.addEventListener("click", () => {
    MODAL.showModal();
  })




  CLOSE.addEventListener('click', () => {
    MODAL.close();
  })

});



