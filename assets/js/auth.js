document.querySelectorAll('[data-password-toggle]').forEach((toggle) => {
    const input = document.getElementById(toggle.dataset.passwordToggle);
    const icon = toggle.querySelector('i');

    if (!input || !icon) {
        return;
    }

    toggle.addEventListener('click', () => {
        const isVisible = input.type === 'text';
        input.type = isVisible ? 'password' : 'text';
        toggle.setAttribute('aria-pressed', String(!isVisible));
        toggle.setAttribute('aria-label', isVisible ? 'Tampilkan password' : 'Sembunyikan password');
        icon.classList.toggle('bi-eye', isVisible);
        icon.classList.toggle('bi-eye-slash', !isVisible);
    });
});

const registerForm = document.getElementById('register-form');

if (registerForm) {
    const password = registerForm.querySelector('#password');
    const confirmPassword = registerForm.querySelector('#confirm-password');

    const validatePasswordMatch = () => {
        if (confirmPassword.value && password.value !== confirmPassword.value) {
            confirmPassword.setCustomValidity('Konfirmasi password belum sama.');
        } else {
            confirmPassword.setCustomValidity('');
        }
    };

    password.addEventListener('input', validatePasswordMatch);
    confirmPassword.addEventListener('input', validatePasswordMatch);
    registerForm.addEventListener('submit', validatePasswordMatch);
}
