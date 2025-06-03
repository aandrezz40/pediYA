document.getElementById('formRegistro').addEventListener('submit', function(e) {
    const contrasena = document.getElementById('inputContrasena').value;
    const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
    if (!regex.test(contrasena)) {
      e.preventDefault(); // Detiene el envío
      // Muestra modal de error
        document.getElementById('mensajeError').textContent =
        'La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula, un número y un carácter especial.';
        document.getElementById('modalError').showModal();
    }
});

  // Cerrar el modal
document.getElementById('cerrarModal').addEventListener('click', function () {
    modal = document.getElementById('modalError');
    modal.close()
});