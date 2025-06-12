document.addEventListener('DOMContentLoaded', () => {
    const contenedores = {
      perfil: document.getElementById('contConfigOpcionesCuenta'),
      personal: document.getElementById('contFormInfoPersonal'),
      seguridad: document.getElementById('contFormSeguridadCuenta'),
      tienda: document.querySelector('.container-info-tienda'),
    };
  
    const botones = {
      personal: document.getElementById('abrirContInfoPersonal'),
      seguridad: document.getElementById('abrirContSeguridad'),
      tienda: document.getElementById('abirContInfoTienda'),
      ajustesCuenta: document.getElementById('btnAjusteCuenta'),
  
      cancelarContrasena: document.getElementById('btnCancelarContrasena'),
      cancelarPersonal: document.getElementById('btnCancelarInfoPersonal'),
      cancelarTienda: document.getElementById('btnCancelarInfoTienda'),
      cancelarHorarios: document.getElementById('btnCancelarHorarios'),
      cancelarPago: document.getElementById('btnCancelarMetodoPago'),
  
      actualizarContrasena: document.getElementById('btnActualizarContrasena'),
  
      tabs: {
        basica: document.getElementById('btnInfoBasica'),
        horarios: document.getElementById('btnDatosEnvio'),
        pago: document.getElementById('btnDatosPago'),
      }
    };
  
    const formsTienda = {
      basica: document.querySelector('.cont-formulario-basico'),
      horarios: document.querySelector('.cont-formulario-horarios'),
      pago: document.querySelector('.cont-formulario-pago'),
    };
  
    const modal = document.getElementById('modalCencelar');
    const btnAceptarModal = document.getElementById('btnAceptarModal');
    const btnCancelarModal = document.getElementById('btnCancelarModal');
  
    const ANIM_BASE = 'animate__animated';
    const ANIM_FADEIN = 'animate__fadeInRight';
  
    const mostrarContenedor = (mostrar) => {
      Object.values(contenedores).forEach(c => c.style.display = 'none');
      if (mostrar) mostrar.style.display = 'flex';
    };
  
    const openConfirm = (onAccept) => {
      modal.showModal();
      const handler = () => {
        onAccept();
        modal.close();
        btnAceptarModal.removeEventListener('click', handler);
      };
      btnAceptarModal.addEventListener('click', handler);
    };
  
    btnCancelarModal?.addEventListener('click', () => modal.close());
  
    botones.personal?.addEventListener('click', () => mostrarContenedor(contenedores.personal));
    botones.seguridad?.addEventListener('click', () => mostrarContenedor(contenedores.seguridad));
    botones.tienda?.addEventListener('click', () => mostrarContenedor(contenedores.tienda));
  
    botones.ajustesCuenta?.addEventListener('click', () => {
      if (window.getComputedStyle(contenedores.perfil).display !== 'flex') {
        openConfirm(() => mostrarContenedor(contenedores.perfil));
      }
    });
  
    [botones.cancelarContrasena, botones.cancelarPersonal, botones.cancelarTienda, botones.cancelarHorarios, botones.cancelarPago]
      .forEach(btn => {
        btn?.addEventListener('click', () => {
          openConfirm(() => console.log('Formulario cancelado'));
        });
      });
  
    // Validación de contraseña
    const validarContrasena = () => {
      const input = document.getElementById('contrasenaNueva');
      const bars = document.querySelectorAll('.progreso');
      const info = document.getElementById('infoDebilidad');
  
      const mensajes = [
        "Débil - Utiliza mínimo 8 caracteres con mayúscula",
        "Medio - Utiliza mínimo 8 caracteres con mayúscula y números",
        "Aceptable - Utiliza mínimo 8 caracteres con mayúsculas, números y símbolos especiales",
        "Segura - tu contraseña cumple todos los requisitos"
      ];
      const colores = ["#eee", "#F75A5A", "#FFA955", "#FFD63A", "#16C47F"];
  
      input?.addEventListener('input', () => {
        const val = input.value;
        const met = [
          val.length >= 6,
          /[A-Z]/.test(val),
          /\d/.test(val),
          /[!@#$%^&*(),.?":{}|<>]/.test(val)
        ].filter(Boolean).length;
  
        bars.forEach((bar, i) => {
          bar.style.backgroundColor = i < met ? colores[i + 1] : colores[0];
        });
  
        info.textContent = mensajes[met - 1] || "Muy débil - Utiliza mínimo 8 caracteres";
      });
    };
  
    if (contenedores.seguridad && window.getComputedStyle(contenedores.seguridad).display === 'flex') {
      validarContrasena();
      botones.actualizarContrasena?.addEventListener('click', () => {
        document.querySelector('.cont-confirmacion-formulario').style.display = 'flex';
      });
    }
  
    // Tabs de info tienda
    const tabs = [
      { btn: botones.tabs.basica, form: formsTienda.basica },
      { btn: botones.tabs.horarios, form: formsTienda.horarios },
      { btn: botones.tabs.pago, form: formsTienda.pago }
    ];
  
    const activarTab = (btnSel) => {
      tabs.forEach(({ btn, form }) => {
        const active = btn === btnSel;
        form.style.display = active ? 'flex' : 'none';
  
        if (form === formsTienda.basica && active) {
          form.classList.remove(ANIM_BASE, ANIM_FADEIN);
          void form.offsetWidth;
          form.classList.add(ANIM_BASE, ANIM_FADEIN);
          form.addEventListener('animationend', () => {
            form.classList.remove(ANIM_BASE, ANIM_FADEIN);
          }, { once: true });
        }
  
        btn.classList.toggle('activeInfoTienda', active);
      });
    };
  
    tabs.forEach(({ btn }) => {
      btn?.addEventListener('click', () => activarTab(btn));
    });
  
  });
  