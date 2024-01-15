
const SUBMIT_BUTTON = document.getElementById('button-submit');
const FORM_LOGIN = document.getElementById("form-login");


document.addEventListener("DOMContentLoaded", () => {


  FORM_LOGIN.addEventListener('submit', login);

})


function login(event) {
  event.preventDefault();

  SUBMIT_BUTTON.disabled = true;
  SUBMIT_BUTTON.classList.add('button--disable')

  var error = document.querySelector('.error');

  if (error != null)
    error.remove();

  var username = document.getElementById('input-username').value;
  var password = document.getElementById('input-password').value;


  $.ajax({
    type: "POST",
    url: "login",
    data: { username: username, password: password, csrf_token: csrf_token },
    dataType: "json",
    success: function (response) {
      switch (response['status']) {
        case "sucess":
          window.location.href = "/public/login";

          break;

        case "error":

          SUBMIT_BUTTON.disabled = false;
          SUBMIT_BUTTON.classList.remove('button--disable')


          var errorDiv = document.createElement("div");
          errorDiv.className = 'error';

          var paragraph = document.createElement("p");
          paragraph.textContent = response['message'];

          errorDiv.appendChild(paragraph);

          SUBMIT_BUTTON.parentElement.appendChild(errorDiv);
          break;
      }
    }
  });
}