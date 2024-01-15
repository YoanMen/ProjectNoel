function passwordValid() {
  const PASSWORD_FORM = document.querySelector('.js-password');
  const SUBMIT_BUTTON = document.getElementById('submitUser');

  const errorDiv = document.createElement('div');
  errorDiv.className = 'error';

  const paragraph = document.createElement('p');
  paragraph.textContent = 'Mot de passe trop court';

  errorDiv.appendChild(paragraph);

  PASSWORD_FORM.addEventListener('input', () => {

    const password = PASSWORD_FORM.value.toString();

    if (password.length < 6) {
      SUBMIT_BUTTON.disabled = true;
      PASSWORD_FORM.parentElement.appendChild(errorDiv);
    }
    else {
      SUBMIT_BUTTON.disabled = false;

      errorDiv.remove();
    }
  })


}

