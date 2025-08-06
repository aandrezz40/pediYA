<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nosotros</title>
    <link rel="stylesheet" href="{{ asset('css/sobreNosotros.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=ADLaM+Display&display=swap" rel="stylesheet">
</head>
<body>
    <main class="timeline-container">
        <a href="{{ auth()->check() ? (auth()->user()->role === 'cliente' ? route('homeCliente') : (auth()->user()->role === 'tendero' ? route('homeTendero') : url('/'))) : url('/') }}" class="icono-salir-nosotros">
            <div class=""><img class="icono-nav cerrar-nav" src="{{ asset('img/x-fill-12_.png') }}" alt="" id="close-nav-bar"></div>
        </a>
        
        <section class="timeline-header">Sobre Nosotros</section>
        <article class="container-cards">
            <section class="timeline-card-container">
                <article class="timeline-card active" data-index="0">
                    <h2>Misión</h2>
                    <p>Empoderar a los pequeños comercios de barrio ofreciendo una plataforma digital accesible que facilite pedidos en línea, mejorando la experiencia del cliente y la competitividad de los tenderos.</p>
                </article>
                <article class="timeline-card" data-index="1">
                    <h2>Visión</h2>
                    <p>Ser la herramienta de referencia que transforme el comercio local, impulsando la digitalización de las tiendas de barrio y promoviendo un ecosistema comercial innovador y sostenible.</p>
                </article>
                <article class="timeline-card" data-index="2">
                    <h2>Historia</h2>
                    <p>PediYÁ es un proyecto de grado desarrollado por aprendices del SENA, surgido de la necesidad de modernizar y digitalizar los procesos comerciales en pequeñas tiendas de barrio. Con la pasión y dedicación de un equipo de jóvenes emprendedores, PediYÁ busca integrar a los comerciantes en el mundo digital, facilitando una experiencia de compra cómoda y segura para sus clientes.</p>
                </article>
            </section>
    
            <section class="timeline-wrapper">
                <div class="timeline-line">
                    <div class="timeline-progress"></div>
                </div>
    
                <div class="timeline-points">
                    <div class="timeline-point active" data-index="0">
                        <div class="timeline-point-inner"></div>
                    </div>
                    <div class="timeline-point" data-index="1">
                        <div class="timeline-point-inner"></div>
                    </div>
                    <div class="timeline-point" data-index="2">
                        <div class="timeline-point-inner"></div>
                    </div>
                </div>
            </section>
    
        </article>
    </main>

    <script src="{{ asset('js/sobreNosotros.js') }}"></script>
</body>
</html>
