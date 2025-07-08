document.addEventListener('DOMContentLoaded', () => {
  // Referencias a contenedores principales
  const contenedores = {
    perfil: document.getElementById('contConfigOpcionesCuenta'),
    personal: document.getElementById('contFormInfoPersonal'),
    seguridad: document.getElementById('contFormSeguridadCuenta'),
    tienda: document.getElementById('contFormInfoTienda'),
  };

  // Referencias a botones principales
  const botones = {
    personal: document.getElementById('abrirContInfoPersonal'),
    seguridad: document.getElementById('abrirContSeguridad'),
    tienda: document.getElementById('abrirContInfoTienda'),

    // Botones de cancelar para formularios
    cancelarContrasena: document.getElementById('btnCancelarContrasena'),
    cancelarContrasena2: document.getElementById('btnCancelarContrasena2'),
    cancelarPersonal: document.getElementById('btnCancelarInfoPersonal'),
    cancelarPersonal2: document.getElementById('btnCancelarInfoPersonal2'),
    cancelarTienda: document.getElementById('btnCancelarInfoTienda'),
    cancelarTienda2: document.getElementById('btnCancelarInfoTienda2'),
  };

  // Modal de confirmación
  const modal = document.getElementById('modalCencelar');
  const btnAceptarModal = document.getElementById('btnAceptarModal');
  const btnCancelarModal = document.getElementById('btnCancelarModal');

  // Debug: verificar que todos los elementos se encuentran
  console.log('Contenedores encontrados:', contenedores);
  console.log('Botones encontrados:', botones);
  console.log('Botón tienda específico:', botones.tienda);

  // Función para mostrar solo el contenedor indicado
  const mostrarContenedor = (seleccionado) => {
    Object.values(contenedores).forEach(c => {
      if (c) c.style.display = 'none';
    });
    if (seleccionado) seleccionado.style.display = 'flex';
  };

  // Lógica global de confirmación en modal
  const openConfirm = (onAccept) => {
    if (!modal) return;
    modal.showModal();
    const handler = () => {
      onAccept();
      modal.close();
      btnAceptarModal.removeEventListener('click', handler);
    };
    btnAceptarModal.addEventListener('click', handler);
  };
  btnCancelarModal?.addEventListener('click', () => modal.close());

  // Abrir secciones Info Personal, Seguridad y Tienda
  botones.personal?.addEventListener('click', () => mostrarContenedor(contenedores.personal));
  botones.seguridad?.addEventListener('click', () => mostrarContenedor(contenedores.seguridad));
  
  // Debug para tienda
  console.log('Botón tienda:', botones.tienda);
  console.log('Contenedor tienda:', contenedores.tienda);
  
  botones.tienda?.addEventListener('click', () => {
    console.log('Botón tienda clickeado');
    mostrarContenedor(contenedores.tienda);
  });

  // Botón Ajustes de Cuenta: retorna al menú principal
  botones.ajustesCuenta?.addEventListener('click', () => {
    if (contenedores.perfil && window.getComputedStyle(contenedores.perfil).display !== 'flex') {
      openConfirm(() => mostrarContenedor(contenedores.perfil));
    }
  });

  // Cancelar Info Personal
  botones.cancelarPersonal?.addEventListener('click', () => {
    openConfirm(() => mostrarContenedor(contenedores.perfil));
  });

  // Funcionalidad de cancelar contraseña: cierra modal y regresa al menú principal
  botones.cancelarContrasena?.addEventListener('click', () => {
    openConfirm(() => mostrarContenedor(contenedores.perfil));
  });

  // Funcionalidad de cancelar tienda: cierra modal y regresa al menú principal
  botones.cancelarTienda?.addEventListener('click', () => {
    openConfirm(() => mostrarContenedor(contenedores.perfil));
  });

  // Validación de contraseña: siempre inicializar
  const validarContrasena = () => {
    const input = document.getElementById('contrasenaNueva');
    const bars = document.querySelectorAll('.progreso');
    const info = document.getElementById('infoDebilidad');
    if (!input || bars.length === 0 || !info) return;

    const mensajes = [
      "Muy débil - Utiliza mínimo 8 caracteres",
      "Débil - Utiliza mínimo 8 caracteres con mayúscula",
      "Medio - Utiliza mínimo 8 caracteres con mayúscula y números",
      "Aceptable - Utiliza mínimo 8 caracteres con mayúsculas, números y símbolos especiales",
      "Segura - tu contraseña cumple todos los requisitos"
    ];
    const colores = ["#eee", "#F75A5A", "#FFA955", "#FFD63A", "#16C47F"];

    input.addEventListener('input', () => {
      const val = input.value;
      const met = [
        val.length >= 8,
        /[A-Z]/.test(val),
        /\d/.test(val),
        /[!@#$%^&*(),.?":{}|<>]/.test(val)
      ].filter(Boolean).length;

      bars.forEach((bar, i) => {
        bar.style.backgroundColor = i < met ? colores[i + 1] : colores[0];
      });
      info.textContent = mensajes[met];
    });
  };

  // Iniciar validación de contraseña y mostrar confirmación
  validarContrasena();

  botones.actualizarContrasena?.addEventListener('click', () => {
    const confirmBox = document.querySelector('.cont-confirmacion-formulario');
    if (confirmBox) confirmBox.style.display = 'flex';
  });
});

//LOGICA SOLO PARA EDITAR LA INFORMACION DE LA TIENDA
document.addEventListener('DOMContentLoaded', () => {
  const tabs = {
    basicaBtn: document.getElementById('btnInfoBasica'),
    horariosBtn: document.getElementById('btnDatosEnvio'),
    pagoBtn: document.getElementById('btnDatosPago'),

    basicaForm: document.querySelector('.cont-formulario-basico'),
    horariosForm: document.querySelector('.cont-formulario-horarios'),
    pagoForm: document.querySelector('.cont-formulario-pago'),
  };

  // Debug: verificar que todos los elementos se encuentran
  console.log('Tabs encontrados:', tabs);
  console.log('Botón básica:', tabs.basicaBtn);
  console.log('Botón horarios:', tabs.horariosBtn);
  console.log('Botón pago:', tabs.pagoBtn);
  console.log('Form básica:', tabs.basicaForm);
  console.log('Form horarios:', tabs.horariosForm);
  console.log('Form pago:', tabs.pagoForm);

  const ANIM_BASE = 'animate__animated';
  const ANIM_FADEIN = 'animate__fadeInRight';

  const activarTab = (seleccionadaBtn) => {
    console.log('Activando tab:', seleccionadaBtn.id);
    Object.entries(tabs).forEach(([key, elem]) => {
      if (!elem) {
        console.log('Elemento no encontrado:', key);
        return;
      }
      if (key.endsWith('Btn')) {
        // button
        elem.classList.toggle('activeInfoTienda', elem === seleccionadaBtn);
        console.log('Botón', key, 'activo:', elem === seleccionadaBtn);
      } else {
        // form
        const mostrar = tabs[seleccionadaBtn.id.replace('Btn', 'Form')];
        const mostrarForm = elem === mostrar;
        elem.style.display = mostrarForm ? 'flex' : 'none';
        console.log('Formulario', key, 'mostrado:', mostrarForm);
        if (elem === tabs.basicaForm && elem.style.display === 'flex') {
          elem.classList.remove(ANIM_BASE, ANIM_FADEIN);
          void elem.offsetWidth;
          elem.classList.add(ANIM_BASE, ANIM_FADEIN);
          elem.addEventListener('animationend', () => {
            elem.classList.remove(ANIM_BASE, ANIM_FADEIN);
          }, { once: true });
        }
      }
    });
  };

  [tabs.basicaBtn, tabs.horariosBtn, tabs.pagoBtn].forEach(btn => {
    btn?.addEventListener('click', () => activarTab(btn));
  });

  // Event listeners para botones de cancelar adicionales de tienda
  const btnCancelarHorarios = document.getElementById('btnCancelarHorarios');
  const btnCancelarMetodoPago = document.getElementById('btnCancelarMetodoPago');
  const contenedores = {
    perfil: document.getElementById('contConfigOpcionesCuenta'),
    tienda: document.getElementById('contFormInfoTienda'),
  };

  btnCancelarHorarios?.addEventListener('click', () => {
    contenedores.tienda.style.display = 'none';
    contenedores.perfil.style.display = 'flex';
  });

  btnCancelarMetodoPago?.addEventListener('click', () => {
    contenedores.tienda.style.display = 'none';
    contenedores.perfil.style.display = 'flex';
  });
});
