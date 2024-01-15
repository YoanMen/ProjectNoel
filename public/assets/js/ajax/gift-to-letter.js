





function addGift({ id = null, button = null }) {
  $.ajax({
    type: "POST",
    url: "addGiftToLetter",
    data: { id: id },
    dataType: "json",
    success: function (response) {
      switch (response['status']) {
        case "sucess":
          console.log("sucess");
          button.outerHTML = `<button class="button button--expanded button--red js-button-letter" onclick='removeGift({id : ${id} , button : this})'>Retirer de ma lettre</button>`;

          break;

        case 'error':
          console.log("sucess");
          break;
      }
    }
  });
}


function removeGift({ id = null, button = null }) {
  $.ajax({
    type: "POST",
    url: "removeGiftfromLetter",
    data: { id: id },
    dataType: "json",
    success: function (response) {
      switch (response['status']) {
        case "sucess":
          console.log("sucess");
          button.outerHTML = `<button class="button button--expanded js-button-letter" onclick='addGift({id: ${id} , button : this })'>Ajouter à ma lettre</button>`;;

          break;

        case 'error':
          console.log("sucess");

          break;
      }
    }
  });
}