const passwordToggle = document.querySelector('.js-password-toggle');
if (passwordToggle) {
  passwordToggle.addEventListener('change', function () {
    const password = document.querySelector('.js-password');
    const passwordLabel = document.querySelector('.js-password-label');

    if (!password || !passwordLabel) {
      return;
    }

    if (password.type === 'password') {
      password.type = 'text';
      passwordLabel.innerHTML = '<i class="fas fa-eye"></i>';
    } else {
      password.type = 'password';
      passwordLabel.innerHTML = '<i class="fas fa-eye-slash"></i>';
    }

    password.focus();
  });
}
