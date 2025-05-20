const cardsPedido = document.querySelectorAll(".cont-card-pedido");

cardsPedido.forEach(card => {
    const estado = card.querySelector(".info-proceso");
    const boton = card.querySelector(".btn-Confirmar-Pedido");

    switch (estado.innerText.trim()) {
        case "En proceso":
            estado.style.color = "orange";
            break;
        case "Entregado":
            estado.style.color = "green";
            boton.style.display = "flex";
            break;
        case "Cancelado":
            estado.style.color = "red";
            break;
        case "Pendiente":
            estado.style.color = "purple";
            break;
        case "Pedido listo":
            estado.style.color = "blue";
            break;
        default:
            boton.style.display = "none";
            break;
    }
});

