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

// ——— 5. Manejo del envío del formulario ———
const form = document.querySelector('.form-registro-tienda');

form.addEventListener('submit', function(event) {
  // No prevenir el envío por defecto para permitir que Laravel maneje la validación
  // y redirección automáticamente
  
  // Mostrar indicador de carga
  const submitBtn = document.getElementById('enviarRegistroTienda');
  const originalText = submitBtn.value;
  submitBtn.value = 'Enviando...';
  submitBtn.disabled = true;
  
  // El formulario se enviará normalmente y Laravel manejará:
  // - Validación y errores (redirigirá de vuelta con errores)
  // - Éxito (redirigirá al home del tendero)
});

// Función para mostrar mensajes de error personalizados
function mostrarError(mensaje) {
  // Crear un elemento de error temporal
  const errorDiv = document.createElement('div');
  errorDiv.className = 'error-message-global';
  errorDiv.style.cssText = `
    position: fixed;
    top: 20px;
    right: 20px;
    background: #dc3545;
    color: white;
    padding: 15px 20px;
    border-radius: 5px;
    z-index: 10000;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    max-width: 300px;
  `;
  errorDiv.textContent = mensaje;
  
  document.body.appendChild(errorDiv);
  
  // Remover después de 5 segundos
  setTimeout(() => {
    if (errorDiv.parentNode) {
      errorDiv.parentNode.removeChild(errorDiv);
    }
  }, 5000);
}

// Función para mostrar mensajes de éxito
function mostrarExito(mensaje) {
  const successDiv = document.createElement('div');
  successDiv.className = 'success-message-global';
  successDiv.style.cssText = `
    position: fixed;
    top: 20px;
    right: 20px;
    background: #28a745;
    color: white;
    padding: 15px 20px;
    border-radius: 5px;
    z-index: 10000;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    max-width: 300px;
  `;
  successDiv.textContent = mensaje;
  
  document.body.appendChild(successDiv);
  
  setTimeout(() => {
    if (successDiv.parentNode) {
      successDiv.parentNode.removeChild(successDiv);
    }
  }, 5000);
}
