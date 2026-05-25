<?php
require_once __DIR__ . "/app/AccesoDatos.php";
require_once __DIR__ . '/app/auth/Auth.php';

$db = AccesoDatos::getModelo();

session_start();
Auth::inactividad();


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="assets/css/estilos_peliculas.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Cormorant+Upright:wght@300;400;500;600;700&family=Dancing+Script:wght@400..700&family=Elms+Sans:ital,wght@0,100..900;1,100..900&family=Fleur+De+Leah&family=Fredoka:wght@300..700&family=Goudy+Bookletter+1911&family=Libre+Baskerville:ital,wght@0,400..700;1,400..700&family=Noto+Naskh+Arabic:wght@400..700&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Tangerine:wght@400;700&family=Updock&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="assets/css/mejoras_ui.css">
</head>

<body>
  <div id="titulo">
    <p>Descubre por géneros...</p>
  </div>
  <!-- menu despleglable -->
  <button class="hamburguesa" id="hamburguesa">
    ☰
  </button>
  <nav class="menu" id="menu">
    <?php if (!isset($_SESSION['usuario'])): ?>
      <a href="auth/login.php">Iniciar Sesión</a>
    <?php else: ?>
      <a href="guardados.php">Mis favoritos</a>
      <a href="auth/login.php?logout=1">Cerrar Sesión</a><!--metemos un 1 por poner algo para que acceda-->
    <?php endif; ?>
    <a href="sinopsis.php">Buscar</a>
    <a href="index.php#recomendaciones">Recomendaciones</a>
  </nav>

  <section>
    <div class="generos">
      <?php foreach ($db->getGeneros('Peli') as $genero): ?>
        <a class="enlaces" href="<?= $genero->tipo; ?>.php">
          <div class="cuadrado">
            <img src="<?= $genero->imagen; ?>" alt="<?= $genero->tipo; ?>">
            <p><?= $genero->tipo; ?></p>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </section>

  <footer class="footer">
    <div class="footercontenedor">
      <div class="footerlogo">
        <img src="imagenes/diseno-de-logo.png" alt="Logo by Diego Ciro & Luz Bietti" class="logo" />
        <p class="nosotros">BY DIEGO<br>CIRO &<br>LUZ BIETTI</p>
      </div>

      <div class="footerseccion">
        <p>IES Tetuán de las victorias<br>
          Tel 999 999 999<br>
          <a>email@gmail.com</a>
        </p>
      </div>
    </div>

    <div class="footerbottom">
      <div class="social">
        <p>Redes Sociales</p>
        <div class="iconos">
          <a href="#"><img src="imagenes/facebook.png" alt="Facebook"></a>
          <a href="#"><img src="imagenes/instagram.png" alt="Instagram"></a>
          <a href="#"><img src="imagenes/linkedin.png" alt="Instagram"></a>
        </div>
      </div>
    </div>
  </footer>
  <script src="assets/js/mejoras_ui.js"></script>
</body>

</html>