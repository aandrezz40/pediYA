const inputContrasena = document.getElementById('inputContrasena');
const imgContrasena = document.getElementById('imgOjo');

imgContrasena.addEventListener('click', () => {
    if (inputContrasena.type === 'password') {
        inputContrasena.type = 'text';
        imgContrasena.classList.add('visibility-contra');
    } else {
        inputContrasena.type = 'password';
        imgContrasena.classList.remove('visibility-contra');
    }
});