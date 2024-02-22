<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!--
    - primary meta tags
  -->
  <title>Oil-Center - Servicio de Mantenimiento de Automóviles</title>
  <meta name="title" content="Oil-Center - Servicio de Mantenimiento de Automóviles">
  <meta name="description" content="Esta es una plantilla html de reparación de vehículos hecha por mnina">

  <!--
    - favicon
  -->
  <link rel="shortcut icon" href="./landing/favicon.svg" type="image/svg+xml">

  <!--
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@400;600;700&family=Mulish&display=swap"
    rel="stylesheet">

  <!--
    - material icon font
  -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@40,600,0,0" />

  <!--
    - custom css link
  -->
  <link rel="stylesheet" href="./landing/assets/css/style.css">

  <!--
    - preload images
  -->
  <link rel="preload" as="image" href="./landing/assets/images/hero-banner.png">
  <link rel="preload" as="image" href="./landing/assets/images/hero-bg.jpg">

</head>

<body>

  <!--
    - #HEADER
  -->
<style>
  .has-scrollbar {
    overflow-y: auto; /* Esto habilitará el scrollbar vertical cuando sea necesario */
    max-height: 500px; /* Establece una altura máxima para evitar que el contenedor se haga demasiado largo */
}
</style>
  <header class="header">
    <div class="container">

      <a href="#" class="logo">
        <img src="./landing/assets/images/logo.png" width="128" height="63" alt="autofix home">
      </a>

      <nav class="navbar" data-navbar>
        <ul class="navbar-list">

          <li>
            <a href="#" class="navbar-link">Principal</a>
          </li>

          <li>
            <a href="#" class="navbar-link">Sobre Nosotros</a>
          </li>

          <li>
            <a href="#" class="navbar-link">Servicios</a>
          </li>

          <li>
            <a href="#" class="navbar-link">Blog</a>
          </li>

          <li>
            <a href="#" class="navbar-link">Cantacto</a>
          </li>

        </ul>
      </nav>

      <a href="{{ route('login') }}" class="btn btn-primary">
        <span class="span">Inicio de Sesión</span>

        <span class="material-symbols-rounded">arrow_forward</span>
      </a>

      <button class="nav-toggle-btn" aria-label="toggle menu" data-nav-toggler>
        <span class="nav-toggle-icon icon-1"></span>
        <span class="nav-toggle-icon icon-2"></span>
        <span class="nav-toggle-icon icon-3"></span>
      </button>

    </div>
  </header>





  <main>
    <article>

      <!--
        - #HERO
      -->

      <section class="hero has-bg-image" aria-label="home" style="background-image: url('./landing/assets/images/hero-bg.jpg')">
        <div class="container">

          <div class="hero-content">
            <p class="section-subtitle :dark"> Contamos con mecánicos talentosos.</p>

            <h1 class="h1 section-title">Servicio de Mantenimiento de Autos</h1>

            <p class="section-text">
                Tu auto merece lo mejor. Ofrecemos mantenimiento excepcional para asegurar tu tranquilidad en cada viaje. Confía en nosotros, cuidamos de tu vehículo con pasión y experiencia
            </p>

            <a href="#" class="btn">
              <span class="span">Nuestros servicios</span>

              <span class="material-symbols-rounded">arrow_forward</span>
            </a>

          </div>

          <figure class="hero-banner" style="--width: 1228; --height: 789;">
            <img src="./landing/assets/images/hero-banner.png" width="1228" height="789" alt="red motor vehicle"
              class="move-anim">
          </figure>

        </div>
      </section>





      <!--
        - #SERVICE
      -->

      <section class="section service has-bg-image" aria-labelledby="service-label"
        style="background-image: url('./landing/assets/images/service-bg.jpg')">
        <div class="container">

          <p class="section-subtitle :light" id="service-label">Nuestros servicios</p>

          <h2 class="h2 section-title">Brindamos excelentes servicios para su vehículo</h2>

          <ul class="service-list">

            <li>
              <div class="service-card">

                <figure class="card-icon">
                  <img src="./landing/assets/images/services-1.png" width="110" height="110" loading="lazy" alt="Engine Repair">
                </figure>

                <h3 class="h3 card-title">Engine Repair</h3>

                <p class="card-text">
                  Autem velaum iure reare aenderit rui in ea roluptate esse ruam moles
                </p>

                <a href="#" class="btn-link">Read more</a>

              </div>
            </li>

            <li>
              <div class="service-card">

                <figure class="card-icon">
                  <img src="./landing/assets/images/services-2.png" width="110" height="110" loading="lazy" alt="Brake Repair">
                </figure>

                <h3 class="h3 card-title">Brake Repair</h3>

                <p class="card-text">
                  Autem velaum iure reare aenderit rui in ea roluptate esse ruam moles
                </p>

                <a href="#" class="btn-link">Read more</a>

              </div>
            </li>

            <li>
              <div class="service-card">

                <figure class="card-icon">
                  <img src="./landing/assets/images/services-3.png" width="110" height="110" loading="lazy" alt="Tire Repair">
                </figure>

                <h3 class="h3 card-title">Tire Repair</h3>

                <p class="card-text">
                  Autem velaum iure reare aenderit rui in ea roluptate esse ruam moles
                </p>

                <a href="#" class="btn-link">Read more</a>

              </div>
            </li>

            <li>
              <div class="service-card">

                <figure class="card-icon">
                  <img src="./landing/assets/images/services-4.png" width="110" height="110" loading="lazy"
                    alt="Battery Repair">
                </figure>

                <h3 class="h3 card-title">Battery Repair</h3>

                <p class="card-text">
                  Autem velaum iure reare aenderit rui in ea roluptate esse ruam moles
                </p>

                <a href="#" class="btn-link">Read more</a>

              </div>
            </li>

            <li class="service-banner">
              <img src="./landing/assets/images/services-5.png" width="646" height="380" loading="lazy" alt="Red Car"
                class="move-anim">
            </li>

            <li>
              <div class="service-card">

                <figure class="card-icon">
                  <img src="./landing/assets/images/services-6.png" width="110" height="110" loading="lazy"
                    alt="Steering Repair">
                </figure>

                <h3 class="h3 card-title">Steering Repair</h3>

                <p class="card-text">
                  Autem velaum iure reare aenderit rui in ea roluptate esse ruam moles
                </p>

                <a href="#" class="btn-link">Read more</a>

              </div>
            </li>

          </ul>

          <a href="#" class="btn">
            <span class="span">Ver Todos los Servicios</span>

            <span class="material-symbols-rounded">arrow_forward</span>
          </a>

        </div>
      </section>





      <!--
        - #ABOUT
      -->

      <section class="section about has-before" aria-labelledby="about-label">
        <div class="container">

          <figure class="about-banner">
            <img src="./landing/assets/images/about-banner.png" width="540" height="540" loading="lazy"
              alt="vehicle repire equipments" class="w-100">
          </figure>

          <div class="about-content">

            <p class="section-subtitle :dark">Sobre Nosotros</p>

            <h2 class="h2 section-title">Estamos comprometidos a cumplir con la calidad</h2>

            <p class="section-text">
                En Oil-Center, nos dedicamos apasionadamente a proporcionar el mejor servicio de mantenimiento automotriz. Con años de experiencia y un equipo comprometido, garantizamos la excelencia en cada detalle. Nuestra misión es cuidar de tu vehículo para que puedas disfrutar de la carretera con total confianza. Descubre la diferencia con Oil-Center.
            </p>



            <ul class="about-list">

              <li class="about-item">
                <p>
                  <strong class="display-1 strong">8K+</strong> Clientes Felices
                </p>
              </li>

              {{-- <li class="about-item">
                <p>
                  <strong class="display-1 strong">22+</strong> Instrumentos
                </p>
              </li> --}}

              <li class="about-item">
                <p>
                  <strong class="display-1 strong">10+</strong> Años en el Mercado
                </p>
              </li>

              {{-- <li class="about-item">
                <p>
                  <strong class="display-1 strong">99%</strong> Projects completed
                </p>
              </li> --}}

            </ul>

          </div>

        </div>
      </section>





      <!--
        - #WORK
      -->

      <section class="section work" aria-labelledby="work-label">
        <div class="container">

          <p class="section-subtitle :light" id="work-label">Nuestro Trabajo</p>

          <h2 class="h2 section-title">Algunos de los trabajos realizados</h2>

          <ul class="has-scrollbar">
            @foreach ($publicaciones as $publi)
            <li class="scrollbar-item">
              <div class="work-card">

                <figure class="card-banner img-holder" style="--width: 350; --height: 406;">
                  <img src="{{ asset('imagenes/publicacion/'.$publi->imagen) }}" width="350" height="406" loading="lazy" alt="Engine Repair"
                    class="img-cover">
                </figure>

                <div class="card-content">
                  {{-- <p class="card-subtitle">Reparación Automática</p> --}}

                  <h3 class="h3 card-title">{{ $publi->titulo }}</h3>

                  <a href="#" class="card-btn">
                    <span class="material-symbols-rounded">arrow_forward</span>
                  </a>
                </div>

              </div>
            </li>
            @endforeach
          </ul>

        </div>
      </section>

    </article>
  </main>





  <!--
    - #FOOTER
  -->

  <footer class="footer">

    <div class="footer-top section">
      <div class="container">

        <div class="footer-brand">

          <a href="#" class="logo">
            <img src="./landing/assets/images/logo.png" width="128" height="63" alt="autofix home">
          </a>

          <p class="footer-text">
            Rerum necessitatibus saepe eveniet aut et voluptates repudiandae sint et molestiae non recusandae.
          </p>

          <ul class="social-list">

            <li>
              <a href="#" class="social-link">
                <img src="./landing/assets/images/facebook.svg" alt="facebook">
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <img src="./landing/assets/images/instagram.svg" alt="instagram">
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <img src="./landing/assets/images/twitter.svg" alt="twitter">
              </a>
            </li>

          </ul>

        </div>

        <ul class="footer-list">

          <li>
            <p class="h3">Horario de atención</p>
          </li>

          <li>
            <p class="p">Lunes – Sábado</p>

            <span class="span">08.00 – 19.00</span>
          </li>

          {{-- <li>
            <p class="p">Sunday – Thursday</p>

            <span class="span">17.30 – 00.00</span>
          </li>

          <li>
            <p class="p">Friday – Saturday</p>

            <span class="span">12.00 – 14.45</span>
          </li> --}}

        </ul>

        <ul class="footer-list">

          <li>
            <p class="h3">Contacto</p>
          </li>

          <li>
            <a href="tel:+59176160336" class="footer-link">
              <span class="material-symbols-rounded">call</span>

              <span class="span">+591 76160336</span>
            </a>
          </li>

          <li>
            <a href="bar21469@gmail.com" class="footer-link">
              <span class="material-symbols-rounded">mail</span>

              <span class="span">bar21469@gmail.com</span>
            </a>
          </li>

          <li>
            <address class="footer-link address">
              <span class="material-symbols-rounded">location_on</span>

              <span class="span">Avenida las Banderas entre calle Saavedra</span>
            </address>
          </li>

        </ul>

      </div>

      <img src="./landing/assets/images/footer-shape-3.png" width="637" height="173" loading="lazy" alt="Shape"
        class="shape shape-3 move-anim">

    </div>

    <div class="footer-bottom">
      <div class="container">

        <p class="copyright">Copyright 2024, OilCenter Todos los derechos reservados.</p>

        <img src="./landing/assets/images/footer-shape-2.png" width="778" height="335" loading="lazy" alt="Shape"
          class="shape shape-2">

        <img src="./landing/assets/images/footer-shape-1.png" width="805" height="652" loading="lazy" alt="Red Car"
          class="shape shape-1 move-anim">

      </div>
    </div>

  </footer>





  <!--
    - custom js link
  -->
  <script src="./landing./assets/js/script.js"></script>

</body>

</html>
