(function () {
    document.addEventListener('click', function (event) {
        var toggle = event.target.closest('.showHiddenPassword-toggle');
        if (!toggle) {
            return;
        }

        var wrapper = toggle.closest('.showHiddenPassword-wrapper');
        var targetSelector = toggle.dataset.target;
        var passwordField = null;

        if (targetSelector) {
            if (wrapper) {
                passwordField = wrapper.querySelector(targetSelector);
            }

            if (!passwordField) {
                passwordField = document.querySelector(targetSelector);
            }
        }

        // Fallback for Symfony-generated IDs that may differ from data-target.
        if (!passwordField && wrapper) {
            passwordField = wrapper.querySelector('input[type="password"], input[type="text"]');
        }

        var icon = toggle.querySelector('i');
        if (!passwordField || !icon) {
            return;
        }

        var isHidden = passwordField.type === 'password';
        passwordField.type = isHidden ? 'text' : 'password';

        icon.classList.toggle('fa-eye-slash', !isHidden);
        icon.classList.toggle('fa-eye', isHidden);
    });
})();
