
document.addEventListener("DOMContentLoaded", () => {

  const FORM_EXPERIENCE = document.getElementById("form-experience");


  FORM_EXPERIENCE.addEventListener('submit', submitFormExperience);

}

)




// using ajax to send experience to server
function submitFormExperience(event) {

  event.preventDefault();

  var speudo = document.getElementById("speudo-input").value;
  var experience = document.getElementById("experience-input").value;
  var csrf_token = document.getElementById("csrf_token").value;

  $.post("experience", { speudo: speudo, experience: experience, csrf_token: csrf_token },
    function (data, textStatus, jqXHR) {
      const BUTTON = document.querySelector(".js-button-send");

      switch (data['status']) {
        case 'success':

          const DISABLE = document.querySelectorAll(".js-desactive-send");



          DISABLE.forEach(element => {
            element.disabled = true;
          });

          BUTTON.outerHTML = "<div class='alert'><p> " + data['message'] + "</p> </div>";

          break;

        case 'error':

          var errorDiv = document.createElement('div');
          errorDiv.className = 'error';

          var paragraph = document.createElement('p');
          paragraph.textContent = data['message'];

          errorDiv.appendChild(paragraph);


          BUTTON.parentElement.appendChild(errorDiv);

          break;
      }

    },

  );

}
