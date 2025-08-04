const cardsPedido = document.querySelectorAll(".cont-card-pedido");

// Definición centralizada de colores y textos por estado
const estadoConfig = {
    "Confirmado":   { text: "En proceso", color: "#1e40af", showBtn: false }, // Azul fuerte
    "En proceso":   { text: "En proceso", color: "#1e40af", showBtn: false },
    "Entregado":    { color: "#22c55e", showBtn: true },   // Verde
    "Cancelado":    { color: "#ef4444", showBtn: false },  // Rojo
    "Pendiente":    { color: "#a21caf", showBtn: false },  // Morado
    "Pedido listo": { color: "#2563eb", showBtn: false },  // Azul medio
};

cardsPedido.forEach(card => {
    const estado = card.querySelector(".info-proceso");
    const boton = card.querySelector(".btn-Confirmar-Pedido");
    const estadoOriginal = estado.innerText.trim();

    const config = estadoConfig[estadoOriginal];

    if (config) {
        if (config.text) estado.textContent = config.text;
        estado.style.color = config.color;
        if (boton) boton.style.display = config.showBtn ? "flex" : "none";
    } else {
        if (boton) boton.style.display = "none";
    }
});

