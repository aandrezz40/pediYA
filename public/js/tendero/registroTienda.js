//MOSTRAR LA IMAGEN QUE SE SUBE EN EL INPUT DE TIPO FILE
const fileInput = document.getElementById('imagenInput');
const preview = document.getElementById('preview');

fileInput.addEventListener('change', function () {
  preview.innerHTML = ''; // Limpia vista previa previa
  const files = Array.from(this.files);

  files.forEach(file => {
    const reader = new FileReader();
    reader.onload = function (e) {
      const img = document.createElement('img');
      img.src = e.target.result;
      img.style.width = '100px';
      img.style.margin = '10px';
      preview.appendChild(img);
    };
    reader.readAsDataURL(file);
  });
});

// ——— 1. Referencias al DOM ———
const barraProgresoRegistro = document.querySelector('.barra-progreso');
const contadorPasoActual     = document.querySelector('.paso-actual');

const contenedores = [
  document.querySelector('.cont-form-info-basica'),
  document.querySelector('.cont-form-info-2'),
  document.querySelector('.cont-form-info-3')
];

const btnSiguiente   = document.querySelector('.btn-siguiente');
const btnAnterior    = document.querySelector('.btn-volver');
const btnEnviarForm  = document.getElementById('enviarRegistroTienda');

// Número total de pasos
const TOTAL_PASOS = contenedores.length;

// Paso actual (0 = primera sección)
let pasoActual = 0;

// ——— 2. Función de renderizado del paso ———
function renderizarPaso(direccion) {
  // 2.1 Mostrar/ocultar contenedores
  contenedores.forEach((cont, i) => {
    if (i === pasoActual) {
      cont.style.display = 'grid';
      // animación de entrada
      cont.classList.remove('animate__animated','animate__fadeInRight','animate__fadeInLeft');
      void cont.offsetWidth; // forzar reflow
      cont.classList.add('animate__animated',
                         direccion === 'next' ? 'animate__fadeInRight' : 'animate__fadeInLeft');
    } else {
      cont.style.display = 'none';
      cont.classList.remove('animate__animated','animate__fadeInRight','animate__fadeInLeft');
    }
  });

  // 2.2 Actualizar barra de progreso
  const porcentaje = ((pasoActual + 1) / TOTAL_PASOS) * 100;
  barraProgresoRegistro.style.width = porcentaje + '%';

  // 2.3 Actualizar contador de paso (p.ej. "Paso 2 de 3")
  contadorPasoActual.textContent = `Paso ${pasoActual + 1} de ${TOTAL_PASOS}`;

  // 2.4 Mostrar/ocultar botones
  btnAnterior.style.visibility = pasoActual === 0 ? 'hidden' : 'visible';
  btnSiguiente.style.display  = pasoActual === TOTAL_PASOS - 1 ? 'none' : 'inline-block';
  btnEnviarForm.style.display = pasoActual === TOTAL_PASOS - 1 ? 'inline-block' : 'none';
}

// ——— 3. Listeners de navegación ———
btnSiguiente.addEventListener('click', () => {
  if (pasoActual < TOTAL_PASOS - 1) {
    pasoActual++;
    renderizarPaso('next');
  }
});

btnAnterior.addEventListener('click', () => {
  if (pasoActual > 0) {
    pasoActual--;
    renderizarPaso('back');
  }
});

// ——— 4. Inicialización al cargar ———
document.addEventListener('DOMContentLoaded', () => {
  renderizarPaso('next'); // 'next' o 'back' no importa en el primer render
});


// Referencias
const form       = document.querySelector('.form-registro-tienda');
const modal      = document.getElementById('modalExito');
const btnCerrar  = document.getElementById('btnCerrarModal');

form.addEventListener('submit', function(event) {
  event.preventDefault(); // 1) Evita el envío sincronous tradicional

  // 2) Empaqueta los datos del formulario
  const datos = new FormData(form);

  // 3) Envía los datos vía fetch (POST)
  fetch(form.action, {
    method: form.method,    // "POST"
    body: datos
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('Hubo un problema al enviar el formulario');
    }
    return response.json();  // o response.text(), según tu API
  })
  .then(data => {
    // 4) Aquí ya sabemos que el envío fue exitoso
    modal.showModal();       // abre el <dialog>
  })
  .catch(err => {
    console.error(err);
    alert('Error al enviar. Intenta de nuevo.');
  });
});

// Cerrar el modal cuando el usuario pulse
btnCerrar.addEventListener('click', () => modal.close());
