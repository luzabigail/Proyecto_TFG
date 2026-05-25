<?php
require_once __DIR__ . '/app/config.php';
require_once __DIR__ . '/app/auth/Auth.php';
require_once __DIR__ . '/app/AccesoDatos.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
Auth::inactividad();

$db = AccesoDatos::getModelo();
$usuarioActual = $_SESSION['usuario'] ?? 'usuario';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar_favorito'], $_POST['id_material'])) {
    if (isset($_SESSION['usuario'])) {
        $db->eliminarFav($_SESSION['usuario'], (int) $_POST['id_material']);
    }
    header('Location: guardados.php');
    exit;
}

$misFavoritos = $db->mostrarFav($usuarioActual);
$totalFavoritos = is_array($misFavoritos) ? count($misFavoritos) : 0;
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis favoritos</title>
    <link rel="icon" href="imagenes/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Open+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="assets/css/estilos_guardados.css">
    <link rel="stylesheet" href="assets/css/mejoras_ui.css">
</head>

<body class="pagina-favoritos">
    <button class="hamburguesa" id="hamburguesa">
        ☰
    </button>
    <nav class="menu" id="menu">
        <?php if (!isset($_SESSION['usuario'])): ?>
            <a href="auth/login.php">Iniciar Sesión</a>
        <?php else: ?>
            <a href="auth/login.php?logout=1">Cerrar Sesión</a><!--metemos un 1 por poner algo para que acceda-->
        <?php endif; ?>
        <a href="index.php">Menú principal</a>
        <a href="sinopsis.php">Buscar</a>
        <a href="index.php#recomendaciones">Recomendaciones</a>
    </nav>
    <header class="favoritos-hero">
        <div class="hero-overlay">
            <div class="hero-content">
                <span class="hero-kicker">Tu colección personal</span>
                <h1>Los favoritos de <?php echo htmlspecialchars($usuarioActual); ?></h1>
                <p>
                    Aquí tienes reunidos tus libros y películas guardados.
                </p>
                <div class="hero-actions">
                    <a href="sinopsis.php" class="boton-principal">Seguir explorando</a>
                    <a href="index.php#recomendaciones" class="boton-secundario">Ver recomendaciones</a>
                </div>
            </div>
        </div>
    </header>

    <main class="favoritos-main">
        <section class="panel-resumen seccion-con-difuminado">
            <div class="resumen-card">
                <p class="resumen-etiqueta">Guardados</p>
                <p class="resumen-numero"><?php echo $totalFavoritos; ?></p>
                <p class="resumen-texto">
                    <?php echo $totalFavoritos === 1 ? 'Elemento guardado en favoritos' : 'Elementos guardados en favoritos'; ?>
                </p>
            </div>
            <div class="resumen-card resumen-card-secundaria">
                <p class="resumen-etiqueta">Sugerencia</p>
                <p class="resumen-mensaje">
                    Haz clic en cualquier portada para volver a su ficha y seguir explorando títulos relacionados.
                </p>
            </div>
        </section>

        <section class="favoritos-lista seccion-con-difuminado">
            <div class="cabecera-seccion">
                <div>
                    <span class="subtitulo">Biblioteca guardada</span>
                    <h2>Tus favoritos en un vistazo</h2>
                </div>

            </div>

            <?php if ($totalFavoritos > 0): ?>
                <div class="mejorvalorados2">
                    <?php foreach ($misFavoritos as $favi): ?>
                        <?php $idEnlace = ($favi->id % 2 === 0) ? ($favi->id - 1) : $favi->id; ?>
                        <article class="fotosvalorados">
                            <a class="portada-favorito" href="romancepareja.php?id=<?= $idEnlace ?>">
                                <img src="<?= htmlspecialchars($favi->imagen) ?>" alt="<?= htmlspecialchars($favi->titulo) ?>">
                            </a>
                            <div class="descvalorados">
                                <span class="chip-tipo"><?= htmlspecialchars($favi->tipo . ' · ' . $favi->anio) ?></span>
                                <h3><?= htmlspecialchars($favi->titulo) ?></h3>
                                <p class="autor-favorito"><?= htmlspecialchars($favi->autor) ?></p>
                                <div class="acciones-favorito">
                                    <a class="enlace-detalle" href="romancepareja.php?id=<?= $idEnlace ?>">Ver detalle</a>
                                    <form action="" method="POST" class="form-eliminar-favorito">
                                        <input type="hidden" name="id_material" value="<?= (int) $favi->id ?>">
                                        <button type="submit" name="eliminar_favorito"
                                            class="btn-eliminar-favorito">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="estado-vacio">
                    <div class="estado-vacio-icono">❤</div>
                    <h3>Aún no has guardado favoritos</h3>
                    <p>
                        Cuando marques libros o películas con “me gusta”, aparecerán aquí automáticamente.
                    </p>
                    <a href="index.php#recomendaciones" class="boton-principal">Empezar a guardar</a>
                </div>
            <?php endif; ?>
        </section>
    </main>

    <script src="assets/js/mejoras_ui.js"></script>
</body>

</html>