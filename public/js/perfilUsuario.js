//LOGICA PARA EL CONTENEDOR DE PERFIL DE USUARIO
const contenedorPrincipalPerfil =  document.querySelector('.cont-config-opciones');
const contenedorInformacionPersonal =  document.querySelector('.cont-form-personal');
const contenedorSeguridad =  document.querySelector('.container-form-seguridad');
const contenedorInfoTienda = document.querySelector('.container-info-tienda')
const abrirContInfoPersonal = document.getElementById('abrirContInfoPersonal');
const abrirContSeguridad = document.getElementById('abrirContSeguridad');
const abrirContInfoTienda = document.getElementById('abirContInfoTienda');

//ABRIR EL CONTENEDOR DE INFORMACION PERSONAL
abrirContInfoPersonal.addEventListener('click', function() {
  contenedorInformacionPersonal.style.display = 'flex';
  contenedorPrincipalPerfil.style.display = 'none';
});

//ABRIR EL CONTENEDOR DE SEGURIDAD
abrirContSeguridad.addEventListener('click', function() {
  contenedorSeguridad.style.display = 'flex';
  contenedorPrincipalPerfil.style.display = 'none';
});

abrirContInfoTienda.addEventListener('click', function() {
  contenedorInfoTienda.style.display = 'flex';
  contenedorPrincipalPerfil.style.display = 'none';
});


// Función para verificar si un elemento está oculto
function estaOculto(elemento) {
    const estilo = window.getComputedStyle(elemento);
    return estilo.display === 'none' || estilo.visibility === 'hidden';
}

//LOGICA PARA EL CONTENEDOR DE SEGURIDAD
//VERIFICAR SI EL CONTENEDOR DEL FORMULARIO ESTA PRESENTE EN EL VIEWPORT
if(estaOculto(contenedorSeguridad) === true){
    const btnActualizarContrasena = document.getElementById('btnActualizarContrasena');
   // Si el contenedor es visible, ejecuta la función
    validarContrasena();
    btnActualizarContrasena.addEventListener('click', function() {
      mostrarConfirmacionContrasena();
  });
}

//FUNCION PARA VALIDAR LA SEGURIDAD DE LA CONTRASEÑNA EN EL CONTENEDOR DEL FORMULARIO CORRESPONDIENTE
function validarContrasena(){
    const contrasenaInput = document.getElementById('contrasenaNueva');
    const bars = document.querySelectorAll('.progreso');
    const infoDebilidad = document.getElementById('infoDebilidad');

    // Mensajes según nivel
    const mensajes = [
      "Débil - Utiliza mínimo 8 caracteres con mayúscula",
      "Medio - Utiliza mínimo 8 caracteres con mayúscula y números",
      "Aceptable - Utiliza mínimo 8 caracteres con mayúsculas, números y símbolos especiales",
      "Segura - tu contraseña cumple todos los requisitos"
    ];

   // Paleta de colores por nivel
    const levelColors = ["#eee", "#F75A5A", "#FFA955", "#FFD63A", "#16C47F" ];

    contrasenaInput.addEventListener('input', () => {
      const pwd = contrasenaInput.value;

     // Validaciones
      const isLength = pwd.length >= 6;
      const hasUpper = /[A-Z]/.test(pwd);
      const hasNumber = /\d/.test(pwd);
      const hasSpecial = /[!@#$%^&*(),.?":{}|<>_]/.test(pwd);

      // Contar requisitos cumplidos
      const metCount = [isLength, hasUpper, hasNumber, hasSpecial].filter(Boolean).length;

      // Actualizar barras
      bars.forEach((bar, i) => {
        bar.style.backgroundColor = i < metCount ? levelColors[i + 1] : levelColors[0];
      });

      // Actualizar texto
      infoDebilidad.textContent = mensajes[metCount - 1] || "Muy débil - Utiliza mínimo 8 caracteres";
    });

}
//FUNCION PARA MOSTRAR RECUADRO DE CONFIRMACION DE ACTULIZACIÓN DE CONTRASEÑA
  function mostrarConfirmacionContrasena() {
    const confirmacionFormulario = document.querySelector('.cont-confirmacion-formulario');
    confirmacionFormulario.style.display = 'flex';
}

//FUNCIONES DEL MODAL
// ——— Referencias al DOM ———
const modal = document.getElementById('modalCencelar');
const btnAceptarModal = document.getElementById('btnAceptarModal');
const btnCancelarModal = document.getElementById('btnCancelarModal');

const btnCancelarContrasena = document.getElementById('btnCancelarContrasena');
const btnCancelarInfoPersonal = document.getElementById('btnCancelarInfoPersonal');
const btnAjusteCuenta = document.getElementById('btnAjusteCuenta');
const btnCancelarInfoTiendaBasica = document.getElementById('btnCancelarInfoTienda');
const btnCancelarHorariosTienda = document.getElementById('btnCancelarHorarios');
const btnCancelarMetodosPagoTienda = document.getElementById('btnCancelarMetodoPago');

// ——— Funciones auxiliares ———

/**
 * Abre el modal y asigna el handler de "Aceptar", que se auto-elimina tras ejecutarse.
 * @param {Function} onAccept Función a ejecutar cuando el usuario pulse "Aceptar".
 */
function openConfirm(onAccept) {
  modal.showModal();
  const handler = () => {
    onAccept();
    modal.close();
    btnAceptarModal.removeEventListener('click', handler);
  };
  btnAceptarModal.addEventListener('click', handler);
}

/** Cierra el modal inmediatamente */
function closeConfirm() {
  modal.close();
}

// ——— Asignar listener al botón interno "Cancelar" del modal ———
btnCancelarModal.addEventListener('click', closeConfirm);

// ——— Disparadores del modal ———

// 1) Cancelar en formulario de contraseña
if (btnCancelarContrasena) {
  btnCancelarContrasena.addEventListener('click', () => {
    openConfirm(() => {
      // Aquí puedes resetear o limpiar el formulario de seguridad si quieres
      console.log('Formulario de seguridad cancelado por el usuario.');
    });
  });
}

// 2) Cancelar en formulario de información personal
if (btnCancelarInfoPersonal) {
  btnCancelarInfoPersonal.addEventListener('click', () => {
    openConfirm(() => {
      // Aquí puedes resetear o limpiar el formulario de información personal
      console.log('Formulario de info personal cancelado por el usuario.');
    });
  });
}

// 3) Cancelar en formulario de información basica de la tienda
if (btnCancelarInfoTiendaBasica) {
  btnCancelarInfoTiendaBasica.addEventListener('click', () => {
    openConfirm(() => {
      // Aquí puedes resetear o limpiar el formulario de información personal
      console.log('Cancelar en formulario de información basica de la tienda.');
    });
  });
}

// 4) Cancelar en formulario de información de los horarios de la tienda
if (btnCancelarHorariosTienda) {
  btnCancelarHorariosTienda.addEventListener('click', () => {
    openConfirm(() => {
      // Aquí puedes resetear o limpiar el formulario de información personal
      console.log('Cancelar en formulario de información de los horarios de la tienda');
    });
  });
}

// 5) Cancelar en formulario de información de los metodos de pago de la tienda
if (btnCancelarMetodosPagoTienda) {
  btnCancelarMetodosPagoTienda.addEventListener('click', () => {
    openConfirm(() => {
      // Aquí puedes resetear o limpiar el formulario de información personal
      console.log('Cancelar en formulario de información de los metodos de pago de la tienda.');
    });
  });
}
// 6) Ajustes de cuenta: solo si el contenedor principal NO está visible
if (btnAjusteCuenta) {
  btnAjusteCuenta.addEventListener('click', () => {
    const estilos = window.getComputedStyle(contenedorPrincipalPerfil);
    if (estilos.display !== 'flex') {
      openConfirm(() => {
        // Mostrar pestaña principal, ocultar las demás
        contenedorPrincipalPerfil.style.display       = 'flex';
        contenedorInformacionPersonal.style.display   = 'none';
        contenedorSeguridad.style.display             = 'none';
      });
    }
  });
}

if(btnAceptarModal){
  btnAceptarModal.addEventListener('click', function() {
    contenedorSeguridad.style.display = 'none';
    contenedorInformacionPersonal.style.display   = 'none';
    contenedorInfoTienda.style.display   = 'none';
    contenedorPrincipalPerfil.style.display = 'flex';
  });
}


//LOGICA DEL CONTENEDOR PARA ACTUALIZAR LA INFORMACIÓN DE LA TIENDA
const abrirInfoBasica = document.getElementById('btnInfoBasica');
const abrirInfoHorarios = document.getElementById('btnDatosEnvio');
const abrirInfoMetodosPago = document.getElementById('btnDatosPago');

const formInfoBasica = document.querySelector('.cont-formulario-basico');
const formInfoHorarios = document.querySelector('.cont-formulario-horarios');
const formInfoMetodosPago = document.querySelector('.cont-formulario-pago');

const tabs = [
  { btn: abrirInfoHorarios,    form: formInfoHorarios    },
  { btn: abrirInfoMetodosPago, form: formInfoMetodosPago },
  { btn: abrirInfoBasica,      form: formInfoBasica      }
];

// Clases de animación (por ejemplo de Animate.css)
const ANIM_BASE   = 'animate__animated';
const ANIM_FADEIN = 'animate__fadeInRight';

// ——— Función para activar una “pestaña” por índice ———
function activarTab(seleccionada) {
  tabs.forEach(({ btn, form }) => {
    const isActive = btn === seleccionada;

    // Mostrar u ocultar directamente con display
    form.style.display = isActive ? 'flex' : 'none';

    // Manejar animación solo para la sección básica
    if (form === formInfoBasica) {
      if (isActive) {
        form.classList.remove(ANIM_BASE, ANIM_FADEIN);
        void form.offsetWidth; // forzar reflow
        form.classList.add(ANIM_BASE, ANIM_FADEIN);
        form.addEventListener('animationend', () => {
          form.classList.remove(ANIM_BASE, ANIM_FADEIN);
        }, { once: true });
      } else {
        // Asegura que la animación previa se haya limpiado
        form.classList.remove(ANIM_BASE, ANIM_FADEIN);
      }
    }

    // Botón activo visual (puedes mantener esta clase o estilizar inline)
    btn.classList.toggle('activeInfoTienda', isActive);
  });
}

// ——— Asignar listeners a los botones ———
tabs.forEach(({ btn }) => {
  if (!btn) return;
  btn.addEventListener('click', () => activarTab(btn));
});

// Opcional: Al cargar la página, activar la primera sección o dejar todas ocultas
// activarTab(abrirInfoBasica);

// abrirInfoHorarios.addEventListener('click', () => {
//   formInfoHorarios.style.display = 'flex';
//   formInfoBasica.style.display = 'none';
//   formInfoMetodosPago.style.display = 'none';
//   abrirInfoHorarios.classList.add('activeInfoTienda');
//   abrirInfoMetodosPago.classList.remove('activeInfoTienda');
//   abrirInfoBasica.classList.remove('activeInfoTienda');
// });

// abrirInfoMetodosPago.addEventListener('click', () => {
//   formInfoMetodosPago.style.display = 'flex';
//   formInfoHorarios.style.display = 'none';
//   formInfoBasica.style.display = 'none';
//   abrirInfoMetodosPago.classList.add('activeInfoTienda');
//   abrirInfoHorarios.classList.remove('activeInfoTienda');
//   abrirInfoBasica.classList.remove('activeInfoTienda');

// });

// abrirInfoBasica.addEventListener('click', () => {
//   formInfoBasica.style.display = 'flex';
//   formInfoHorarios.style.display = 'none';
//   formInfoMetodosPago.style.display = 'none';
//   abrirInfoBasica.classList.add('activeInfoTienda');
//   abrirInfoMetodosPago.classList.remove('activeInfoTienda');
//   abrirInfoHorarios.classList.remove('activeInfoTienda');
//   formInfoBasica.classList.add('animate__animated','animate__fadeInRight');
// });