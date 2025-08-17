function togglePassword() {
    const passwordField = document.getElementById('password');
    const eyeOpen = document.querySelector('.fa-eye');
    const eyeSlash = document.querySelector('.fa-eye-slash');

    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        eyeOpen.style.display = 'none';
        eyeSlash.style.display = 'inline';
    } else {
        passwordField.type = 'password';
        eyeOpen.style.display = 'inline';
        eyeSlash.style.display = 'none';
    }
}