<?php
require_once __DIR__ . "/app/AccesoDatos.php";
require_once __DIR__ . '/app/auth/Auth.php';

$db = AccesoDatos::getModelo();
session_start();
Auth::inactividad();

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id > 0 && $id % 2 === 0) {
  $id--;
}
$pareja = $db->getParejaPorId($id);
$libro = $pareja[0];
$peli = $pareja[1];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idfavo'])) {
  if (!isset($_SESSION['usuario'])) {
    $_SESSION['retorno'] = "romancepareja.php?id=" . $id;
    header("Location: auth/login.php");
    exit;
  }

  $idfav = (int) $_POST['idfavo'];
  $db->guardarFav($_SESSION['usuario'], $idfav);
  header("Location: romancepareja.php?id=" . $id);
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar_comentario'])) {
  if (isset($_SESSION['usuario'])) {
    $db->eliminarComentario((int) $_POST['id_comentario'], $_SESSION['usuario']);
  }
  header("Location: romancepareja.php?id=" . $id);
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar_comentario'])) {
  if (isset($_SESSION['usuario'])) {
    $valor = (int) $_POST['valoracion'];
    $coment = trim($_POST['comentario']);
    if ($valor >= 1 && $valor <= 5 && $coment !== '') {
      $db->editarComentario((int) $_POST['id_comentario'], $_SESSION['usuario'], $valor, $coment);
    }
  }
  header("Location: romancepareja.php?id=" . $id);
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enviar_comentario'])) {
  if (!isset($_SESSION['usuario'])) {
    $_SESSION['retorno'] = "romancepareja.php?id=" . $id;
    header("Location: auth/login.php");
    exit;
  }

  $user = $_SESSION['usuario'];
  $valor = (int) $_POST['valoracion'];
  $coment = trim($_POST['comentario']);

  if ($valor >= 1 && $valor <= 5 && $coment !== '') {
    $db->guardarComentario($id, $user, $valor, $coment);
  }

  header("Location: romancepareja.php?id=" . $id);
  exit;
}

$comentExistentes = $db->obtenerComentarios($id);
$libroGuardado = isset($_SESSION['usuario']) && $db->existeFav($_SESSION['usuario'], $libro->id);
$peliGuardada = isset($_SESSION['usuario']) && $db->existeFav($_SESSION['usuario'], $peli->id);
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($libro->titulo); ?> - Recomendación</title>
  <link rel="stylesheet" href="assets/css/estilos_vermas.css">
  <link rel="stylesheet" href="assets/css/mejoras_ui.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Cormorant+Upright:wght@300;400;500;600;700&family=Dancing+Script:wght@400..700&family=Elms+Sans:ital,wght@0,100..900;1,100..900&family=Fleur+De+Leah&family=Fredoka:wght@300..700&family=Goudy+Bookletter+1911&family=Libre+Baskerville:ital,wght@0,400..700;1,400..700&family=Noto+Naskh+Arabic:wght@400..700&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Tangerine:wght@400;700&family=Updock&display=swap"
    rel="stylesheet">
</head>

<body>
  <div class="principal">
    <button class="hamburguesa" id="hamburguesa">☰</button>
    <nav class="menu" id="menu">
      <?php if (!isset($_SESSION['usuario'])): ?>
        <a href="auth/login.php?redirigir=romancepareja.php?id=<?= $id ?>">Iniciar Sesión</a>
      <?php else: ?>
        <a href="guardados.php">Mis favoritos</a>
        <a href="auth/login.php?logout=1" class="logout-link">Cerrar Sesión</a>
      <?php endif; ?>
      <a href="sinopsis.php">Buscar</a>
      <a href="index.php#recomendaciones">Recomendaciones</a>
      <a href="index.php">Menú principal</a>
    </nav>

    <!-- <div class="flor1"><img src="imagenes/ornamento_hojas.png" alt=""></div> -->
    <section class="recomendaciones">
      <div class="banner">
        <img src="<?= htmlspecialchars($libro->imagen); ?>" class="bannerimg"
          alt="<?= htmlspecialchars($libro->titulo); ?>">
        <div class="sinopsis">
          <h3><?= htmlspecialchars($libro->titulo); ?> (<?= htmlspecialchars($libro->anio); ?>)</h3>
          <p><?= htmlspecialchars($libro->sinopsis); ?></p>
          <div class="contenedor-favorito">
            <form action="" method="POST" class="form-favorito">
              <input type="hidden" name="idfavo" value="<?= $libro->id; ?>">
              <button type="submit" name="corazon" class="favorito <?= $libroGuardado ? 'guardado' : ''; ?>"
                <?= $libroGuardado ? 'disabled' : ''; ?>>
                <img src="imagenes/<?= $libroGuardado ? 'corazon.png' : 'corazon_vacio.png'; ?>"
                  data-vacio="imagenes/corazon_vacio.png" data-lleno="imagenes/corazon.png" alt="Guardar en favoritos">
              </button>
            </form>
          </div>
          <p class="comtext">¿Dónde conseguirlo?</p>
          <div class="logos"><img src="imagenes/Amazon-logo2.png"><img src="imagenes/unnamed.png"></div>
        </div>
      </div>

      <div class="banner">
        <img src="<?= htmlspecialchars($peli->imagen); ?>" class="bannerimg"
          alt="<?= htmlspecialchars($peli->titulo); ?>">
        <div class="sinopsis">
          <h3><?= htmlspecialchars($peli->titulo); ?> (<?= htmlspecialchars($peli->anio); ?>)</h3>
          <p><?= htmlspecialchars($peli->sinopsis); ?></p>
          <div class="contenedor-favorito">
            <form action="" method="POST" class="form-favorito">
              <input type="hidden" name="idfavo" value="<?= $peli->id; ?>">
              <button type="submit" name="corazon" class="favorito <?= $peliGuardada ? 'guardado' : ''; ?>"
                <?= $peliGuardada ? 'disabled' : ''; ?>>
                <img src="imagenes/<?= $peliGuardada ? 'corazon.png' : 'corazon_vacio.png'; ?>"
                  data-vacio="imagenes/corazon_vacio.png" data-lleno="imagenes/corazon.png" alt="Guardar en favoritos">
              </button>
            </form>
          </div>
          <p class="comtext">¿Dónde verla?</p>
          <div class="logos"><img src="imagenes/prime.png"><img src="imagenes/netflix.png"></div>
        </div>
      </div>
    </section>
    <!-- <div class="flor2"><img src="imagenes/pelicula.png" alt=""></div> -->
    <!-- <div class="flor3"><img src="imagenes/ornamento_hojas.png" alt=""></div> -->
  </div>

  <!-- <div class="flor1"><img src="imagenes/pelicula.png" alt=""></div> -->

  <section class="comentarios">
    <section class="seccionreseñas">
      <h2>Opiniones de la comunidad</h2>
      <div class="header_reseñas">
        <h3>Deja tu valoración</h3>
        <form action="" method="POST">
          <label>Puntuación:</label>
          <select name="valoracion" required>
            <option value="5">⭐⭐⭐⭐⭐ (5)</option>
            <option value="4">⭐⭐⭐⭐ (4)</option>
            <option value="3">⭐⭐⭐ (3)</option>
            <option value="2">⭐⭐ (2)</option>
            <option value="1">⭐ (1)</option>
          </select>
          <br><br>
          <textarea class="areaAcomentar" name="comentario" placeholder="Escribe aquí tu opinión..."
            required></textarea>
          <br>
          <button type="submit" name="enviar_comentario" class="opinion">PUBLICAR COMENTARIO</button>
        </form>
      </div>

      <div class="lista_comentarios">
        <?php if (count($comentExistentes) > 0): ?>
          <?php foreach ($comentExistentes as $c): ?>
            <?php $esPropio = isset($_SESSION['usuario']) && $_SESSION['usuario'] === $c->usuario; ?>
            <div class="reviewusuario">
              <div class="reviewusuario2">
                <h4><?= htmlspecialchars($c->usuario); ?></h4>
                <p class="fecha"><?= htmlspecialchars($c->fechafinal); ?></p>
              </div>
              <p class="estrellas3"><?php for ($i = 0; $i < $c->valoracion; $i++)
                echo "⭐"; ?></p>
              <p class="comentarioUsuario"><?= htmlspecialchars($c->texto); ?></p>

              <?php if ($esPropio): ?>
                <div class="acciones-comentario">
                  <button type="button" class="btn-editar">Editar</button>
                  <form action="" method="POST" class="form-eliminar-comentario">
                    <input type="hidden" name="id_comentario" value="<?= $c->id; ?>">
                    <button type="submit" name="eliminar_comentario" class="btn-eliminar">Eliminar</button>
                  </form>
                </div>

                <form action="" method="POST" class="form-editar-comentario">
                  <input type="hidden" name="id_comentario" value="<?= $c->id; ?>">
                  <label>Puntuación:</label>
                  <select name="valoracion" required>
                    <?php for ($i = 5; $i >= 1; $i--): ?>
                      <option value="<?= $i; ?>" <?= (int) $c->valoracion === $i ? 'selected' : ''; ?>><?= str_repeat('⭐', $i); ?>
                        (<?= $i; ?>)</option>
                    <?php endfor; ?>
                  </select>
                  <textarea class="areaAcomentar" name="comentario" required><?= htmlspecialchars($c->texto); ?></textarea>
                  <button type="submit" name="editar_comentario" class="opinion">GUARDAR CAMBIOS</button>
                </form>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p style="padding: 20px;">Se el primero en dar tu opinión</p>
        <?php endif; ?>
      </div>
    </section>
  </section>

  <!-- <section class="final"><img src="imagenes/ornamento3.png" alt=""></section> -->

  <footer class="footer">
    <div class="footercontenedor">
      <div class="footerlogo"><img src="imagenes/diseno-de-logo.png" alt="Logo" class="logo" />
        <p class="nosotros">BY DIEGO<br>CIRO &<br>LUZ BIETTI</p>
      </div>
      <div class="footerseccion">
        <h3></h3>
        <p>IES Tetuán de las victorias<br>Tel 999 999 999<br><a>email@gmail.com</a></p>
      </div>
    </div>
    <div class="footerbottom">
      <div class="social">
        <p>Redes Sociales</p>
        <div class="iconos"><a href="#"><img src="imagenes/facebook.png" alt="Facebook"></a><a href="#"><img
              src="imagenes/instagram.png" alt="Instagram"></a><a href="#"><img src="imagenes/linkedin.png"
              alt="LinkedIn"></a></div>
      </div>
    </div>
  </footer>

  <div id="logoutModal" class="logout-modal oculto">
    <div class="logout-card">
      <h2>Cerrar sesión</h2>
      <p>¿Seguro que deseas cerrar sesión?</p>
      <div class="logout-actions">
        <button id="cancelLogout" type="button">Cancelar</button>
        <a href="auth/login.php?logout=1">Cerrar sesión</a>
      </div>
    </div>
  </div>

  <script>

    document.querySelectorAll('.btn-editar').forEach((btn) => {
      btn.addEventListener('click', () => {
        const form = btn.closest('.reviewusuario').querySelector('.form-editar-comentario');
        form.classList.toggle('visible');
      });
    });

    const logoutModal = document.getElementById('logoutModal');
    const cancelLogout = document.getElementById('cancelLogout');
    document.querySelectorAll('.logout-link').forEach((link) => {
      link.addEventListener('click', (e) => {
        e.preventDefault();
        if (logoutModal) logoutModal.classList.remove('oculto');
      });
    });
    if (cancelLogout && logoutModal) cancelLogout.addEventListener('click', () => logoutModal.classList.add('oculto'));
  </script>
  <script src="assets/js/mejoras_ui.js"></script>
</body>

</html>