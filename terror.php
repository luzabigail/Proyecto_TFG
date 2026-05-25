<?php
require_once __DIR__ . "/app/AccesoDatos.php";
$db = AccesoDatos::getModelo();

session_start();

$materiales = $db->getGenerosParejas('terror');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/estilos_terror.css">
    <title>Terror</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Goudy+Bookletter+1911&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/mejoras_ui.css">
</head>
<body>
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
        <a href="index.php">Menú principal</a> 
    </nav>

      <section>
        <div><p class="titulos_libros">Terror</p></div>
      <div class="contenedor-principal">

    <?php 
    $total = count($materiales);
    $pagina = 1;

    for ($i = 0; $i < $total; $i += 2): //recorremos de 2 en 2 ya que van de juntas de par en par
        $libro = $materiales[$i];
        $peli = ($i + 1 < $total) ? $materiales[$i + 1] : null;
        
          $enlace = "romancepareja.php?id=" . $libro->id; //creamos el enlace para la pagina que abriremos
    ?>
    <section class="pareja">
      <a href="<?= $enlace; ?>" class="enlace-bloque">
        <div class="fila-flex">

        <div class="caja-img">
             <img src="<?= $libro->imagen; ?>" alt="<?= $libro->titulo; ?>">
             <div class="descvalorados">
                    <p><?= $libro->tipo . " - " . $libro->anio; ?></p>
                    <p><strong><?= $libro->titulo; ?></strong></p>
                    <p><?= $libro->autor; ?></p>
                </div>
    </div>

    <div class="caja-flor">
       <img src="imagenes/mano_color.png" alt="decoracion">
    </div>

    <div class="caja-img">
    <img src="<?= $peli->imagen; ?>" alt="<?= $peli->titulo; ?>">
    <div class="descvalorados">
                      <p><?= $peli->tipo . " - " . $peli->anio; ?></p>
                      <p><strong><?= $peli->titulo; ?></strong></p>
                      <p><?= $peli->autor; ?></p>
                    </div>
    </div>

                </div>
            </a>
        </section>
    <?php 
        $pagina++; 
    endfor; 
    ?>
</div>

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

