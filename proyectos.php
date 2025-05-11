<?php require_once 'php/db.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Proyectos - MAGONISTAS HM</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Bebas+Neue&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.html">
        <img src="img/logo2.png" alt="Magonistas HM Logo" id="navbar-logo" class="img-fluid">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="index.html">Inicio</a></li>
          <li class="nav-item"><a class="nav-link" href="quienes-somos.html">¿Quiénes Somos?</a></li>
          <li class="nav-item"><a class="nav-link active" href="proyectos.php">Proyectos</a></li>
          <li class="nav-item"><a class="nav-link" href="contacto.html">Contacto</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section Proyectos -->
  <header class="projects-hero">
    <div class="hero-video-container">
      <video autoplay muted loop playsinline class="hero-video">
        <source src="videos/projects-background.mp4" type="video/mp4">
        <img src="img/proyectos-hero.jpg" alt="Proyectos Magonistas HM" class="hero-fallback-img">
      </video>
      <div class="hero-overlay"></div>
    </div>
    <div class="hero-content text-center">
      <h1 class="hero-title animate__animated animate__fadeInDown animate__delay-1s">NUESTRA HISTORIA SOBRE RUEDAS</h1>
      <p class="hero-subtitle animate__animated animate__fadeInUp animate__delay-1-5s">Cada kilómetro, cada evento, cada proyecto cuenta nuestra historia</p>
      <a href="#eventos-pasados" class="btn btn-hero animate__animated animate__fadeInUp animate__delay-2s">
        <span>Ver Cronología</span>
        <i class="fas fa-chevron-down ms-2"></i>
      </a>
    </div>
    <div class="hero-scroll-down animate__animated animate__bounce animate__infinite animate__slow">
      <i class="fas fa-angle-double-down"></i>
    </div>
  </header>

  <!-- Cronología dinámica -->
  <section class="section past-events bg-light" id="eventos-pasados">
    <div class="container">
      <div class="section-header text-center">
        <h2 class="section-title animate__animated animate__fadeIn">CRONOLOGÍA DE EVENTOS</h2>
        <div class="divider mx-auto animate__animated animate__fadeIn animate__delay-1s">
          <span class="divider-line"></span>
          <i class="fas fa-history divider-icon"></i>
          <span class="divider-line"></span>
        </div>
        <p class="section-subtitle animate__animated animate__fadeIn animate__delay-1-5s">Nuestra historia desde el inicio</p>
      </div>

      <div class="timeline">
        <?php
        $stmt = $pdo->query("SELECT * FROM eventos ORDER BY fecha DESC");
        $ultimo_anio = null;

        while ($evento = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $fecha = new DateTime($evento['fecha']);
          $anio = $fecha->format('Y');
          $dia = strtoupper($fecha->format('d M'));
          $img = $evento['imagen'] ? 'php/admin/subir/' . basename(stripslashes($evento['imagen'])) : 'img/default.jpg';

          if ($anio !== $ultimo_anio) {
            echo "<div class='timeline-year'>$anio</div>";
            $ultimo_anio = $anio;
          }

          echo "<div class='timeline-item animate__animated animate__fadeInLeft'>";
          echo "  <div class='timeline-date'>$dia</div>";
          echo "  <div class='timeline-content'>";
          echo "    <div class='timeline-img'>";
          echo "      <img src='$img' alt='" . htmlspecialchars($evento['titulo']) . "'>";
          echo "      <div class='img-badge'>";
          echo "        <span>$dia</span>";
          echo "        <small>" . htmlspecialchars($evento['tipo_evento']) . "</small>";
          echo "      </div>";
          echo "    </div>";
          echo "    <div class='timeline-text'>";
          echo "      <h3>" . htmlspecialchars($evento['titulo']) . "</h3>";
          echo "      <div class='event-meta'>";
          echo "        <span><i class='fas fa-map-marker-alt'></i> " . htmlspecialchars($evento['lugar']) . "</span>";
          echo "        <span><i class='fas fa-road'></i> " . htmlspecialchars($evento['kilometros']) . " km</span>";
          echo "      </div>";
          echo "      <p>" . nl2br(htmlspecialchars($evento['descripcion'])) . "</p>";
          echo "      <a href='evento.php?id={$evento['id']}' class='btn btn-outline-primary btn-sm mt-2'>Ver más</a>";
          echo "    </div>";
          echo "  </div>";
          echo "</div>";
        }
        ?>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 footer-brand">
          <img src="img/logo2.png" alt="Magonistas HM" class="footer-logo">
          <p class="footer-motto">SOMOS PENSAMIENTO Y ACCIÓN</p>
          <div class="footer-social">
            <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
          </div>
        </div>
        <div class="col-lg-4 footer-links">
          <h5>Explora</h5>
          <ul>
            <li><a href="index.html">Inicio</a></li>
            <li><a href="quienes-somos.html">¿Quiénes Somos?</a></li>
            <li><a href="proyectos.php">Proyectos</a></li>
            <li><a href="contacto.html">Contacto</a></li>
          </ul>
        </div>
        <div class="col-lg-4 footer-contact">
          <h5>Conéctate</h5>
          <ul>
            <li><i class="fas fa-map-marker-alt"></i> San Pedro Cholula, Puebla</li>
            <li><i class="fas fa-phone"></i> +52 222 123 4567</li>
            <li><i class="fas fa-envelope"></i> contacto@magonistashm.com</li>
          </ul>
        </div>
      </div>
      <div class="footer-bottom">
        <div class="copyright">
          &copy; 2024 Magonistas HM. Todos los derechos reservados.
        </div>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/ScrollTrigger.min.js"></script>
  <script src="js/main.js"></script>
  <script src="js/animations.js"></script>
</body>
</html>
