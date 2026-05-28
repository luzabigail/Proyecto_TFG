<?php
require_once __DIR__ . "/app/AccesoDatos.php";
session_start();

$db = AccesoDatos::getModelo();

$obras = [];
$busqueda = false;

if (isset($_GET['buscar']) && !empty(trim($_GET['buscar']))) {
  $nuevabusqueda = $_GET['buscar'];

  $obras = $db->buscarMaterial($nuevabusqueda);
  $busqueda = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buscar</title>
  <link rel="stylesheet" href="assets/css/estilos_sinopsis.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Goudy+Bookletter+1911&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="assets/css/mejoras_ui.css">
</head>

<body>
  <header>
    <!-- <div>
            <p class="intro">Busque la pelicula o libro el cual desea buscar una obra que se asemeje y le econtraremos uno
            cuya trama sea similar...</p>
        </div> -->

    <form action="" method="GET" id="buscar">

      <div id="buscarYboton">
        <div id="buscarinput">
          <input id="input" type="text" name="buscar" placeholder="Introducir obra"
            value="<?php echo isset($_GET['buscar']) ? htmlspecialchars($_GET['buscar']) : ''; ?>">
        </div>

        <div id="boton">
          <button type="submit"> Buscar </button>
        </div>

      </div>
      <div class="imagen">
        <video autoplay muted loop src="imagenes/video.mp4"></video>
      </div>
    </form>
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
      <a href="index.php">Menú principal</a>
      <a href="index.php#recomendaciones">Recomendaciones</a>

  </header>

  <div>
    <section class="fondobanners">
      <p id="resultados">
        <?php echo $busqueda ? "Resultados para: " . htmlspecialchars($nuevabusqueda) : "Descubre tu contenido..."; ?>
      </p>
      <div class="fondo">

        <?php if (count($obras) > 0): ?> <!-- confirmamos que al menos haya una obra -->
          <?php foreach ($obras as $obraresu): ?>
            <?php
            $idEnlace = ($obraresu->id % 2 == 0) ? ($obraresu->id - 1) : $obraresu->id; //si es par tenemos la pelicula, si no -1 y tenemos el libro
            ?>

            <div class="banners"> <a href="romancepareja.php?id=<?php echo $idEnlace; ?>">
                <!-- obtenemos el enlace para que la foto esta hipervinculada -->
                <img class="fotosResultado" src="<?php echo $obraresu->imagen; ?>" alt="<?php echo $obraresu->titulo; ?>">
              </a>
              <div class="descvalorados">
                <p id="tituloyanio"><?php echo $obraresu->tipo . " - " . $obraresu->anio; ?></p>
                <p><strong class="nombreBusqueda"><?php echo $obraresu->titulo; ?></strong></p>
                <p><?php echo $obraresu->autor; ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="noEncontrado">
            <p>No se han encontrado resultados para tu búsqueda.</p>
            <p>Inténtalo con otro nombre de libro o película.</p>
          </div>
        <?php endif; ?>
      </div>
  </div>
  </section>

  <section class="final">
    <img src="imagenes/ornamento3.png" alt="">
  </section>


  <footer class="footer">
    <div class="footercontenedor">
      <div class="footerlogo">
        <img src="imagenes/diseno-de-logo.png" alt="Logo by Diego Ciro & Luz Bietti" class="logo" />
        <p class="nosotros">BY DIEGO<br>CIRO &<br>LUZ BIETTI</p>
      </div>

      <div class="footerseccion">
        <h3></h3>
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