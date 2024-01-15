

function confirmDelete({ id = null }) {
  // Ajax pour suprimer removeGift

  $.ajax({
    type: "POST",
    url: "deleteGift",
    data: { id: id },
    dataType: "json",
    success: function (response) {

    }
  });

}

function searchGift() { }


function deleteWantedGift({ name = null }) {
  $.ajax({
    type: "POST",
    url: "deleteWantedGift",
    data: { id: id },
    dataType: "json",
    success: function (response) {

    }
  });
}