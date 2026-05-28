<?php
require_once __DIR__ . "/app/AccesoDatos.php";
session_start();
require_once __DIR__ . '/app/auth/Auth.php';
Auth::inactividad();

$db = AccesoDatos::getModelo();
$materiales = $db->getMaterialesRand();
?>

<!DOCTYPE html>
<html lang="es" class="scroll-smooth">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Film to Read</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" href="imagenes/vista.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Cormorant+Upright:wght@300;400;500;600;700&family=Dancing+Script:wght@400..700&family=Elms+Sans:ital,wght@0,100..900;1,100..900&family=Fleur+De+Leah&family=Fredoka:wght@300..700&family=Goudy+Bookletter+1911&family=Libre+Baskerville:ital,wght@0,400..700;1,400..700&family=Noto+Naskh+Arabic:wght@400..700&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Tangerine:wght@400;700&family=Updock&display=swap"
    rel="stylesheet">

  <link rel="stylesheet" href="assets/css/mejoras_ui.css">
</head>

<body class="pagina-principal m-0 bg-[#ffe9c4] font-elms text-[#3b2f2f] leading-relaxed">
  <header class="hero-video-header sticky top-0 z-0 flex h-[105svh] items-center justify-center overflow-hidden">
    <video class="absolute inset-0 h-full w-full object-cover scale-125 max-md:scale-125 max-lg:scale-125" autoplay
      muted loop playsinline preload="auto" poster="imagenes/header.png">
      <source src="imagenes/header_video_recortado.mp4" type="video/mp4">
    </video>

    <div class="relative z-[1] flex h-full w-full items-center justify-center bg-black/45">
      <div class="text-center text-white">
        <h1 class="text-[7.7rem] font-['Updock'] max-md:text-[4.5rem]">Film to Read</h1>
        <p class="font-goudy text-2xl max-md:text-lg">By Luz Bietti & Diego Ciro</p>
      </div>
    </div>
  </header>

  <button
    class="fixed border right-5 top-4 z-10 cursor-pointer rounded-[5px] bg-[#7a1b1b] px-2.5 py-1 text-[1.8rem] leading-none text-white hover:bg-[#a05a44]"
    id="hamburguesa" type="button" aria-label="Abrir menú">
    ☰
  </button>

  <nav class="fixed border right-5 top-[75px] z-[9] flex w-4/5 flex-col overflow-hidden rounded-lg bg-[#a43e3e92] md:right-10 md:w-auto 
           opacity-0 invisible scale-95 transition-all duration-300 ease-in-out origin-top-right" id="menu">

    <?php if (!isset($_SESSION['usuario'])): ?>
      <a class="block px-6 py-3 text-white no-underline hover:bg-[#a05a44]" href="auth/login.php">Iniciar Sesión</a>
    <?php else: ?>
      <a class="block px-6 py-3 text-white no-underline hover:bg-[#a05a44]" href="guardados.php">Mis favoritos</a>
      <a class="logout-link block px-6 py-3 text-white no-underline hover:bg-[#a05a44]"
        href="auth/login.php?logout=1">Cerrar Sesión</a>
    <?php endif; ?>
    <a class="block px-6 py-3 text-white no-underline hover:bg-[#a05a44]" href="sinopsis.php">Buscar</a>
    <a class="block px-6 py-3 text-white no-underline hover:bg-[#a05a44]"
      href="index.php#recomendaciones">Recomendaciones</a>
  </nav>


  <main class="relative z-10 -mt-8 bg-[#ffe9c4] shadow-[0_-25px_45px_rgba(0,0,0,0.25)]">

    <section class="bg-[#f5e6cf] px-4 py-8 text-center">
      <?php if (isset($_SESSION['usuario'])): ?>
        <h2 class="mb-4 text-3xl text-[#7a1b1b]">Bienvenid@ <?php echo htmlspecialchars($_SESSION['usuario']); ?></h2>
      <?php endif; ?>

      <h2 class="mb-4 text-3xl text-[#7a1b1b]">Redescubre...</h2>
      <p class="mx-auto max-w-[800px] text-xl">
        Film to Read es una plataforma que facilita la búsqueda de libros y películas,
        sugiriendo títulos relacionados con el material que tú proporciones.
        Te ofreceremos los títulos más destacados con lo que más deseas ver o leer y conocerás mas artistas y autores.
      </p>
    </section>

    <div class="relative z-[3] bg-[#a2624c96] shadow-4xl p-[5vh] text-center text-[4vh] italic text-[#7a1b1b]">
      <h3>¿Qué es lo que deseas encontrar?</h3>
    </div>
    <!--  bg-[url(imagenes/Header.png)] bg-no-repeat bg-cover -->
    <section
      class="selector-obras bg-[#e3d0b6] rounded-t-[999px] mt-5 mx-3 flex flex-col items-center justify-center px-4 py-10 text-center md:mx-5 md:flex-row md:py-0">

      <div class="hidden md:block">
        <img src="imagenes/ornamento.png" alt="" class="m-2.5 w-[150px]">
      </div>
      <div class="flex w-full flex-col items-center justify-center gap-8 px-4 py-8 md:w-auto md:flex-row md:p-[10%]">
        <div
          class="w-full  max-w-[300px] overflow-hidden rounded-[15px] bg-white shadow-[0_4px_10px_rgba(0,0,0,0.1)] transition-transform hover:-translate-y-[5px]">
          <div>
            <a href="generos_libros.php"><img class="h-auto w-full" src="<?= $db->getImagenPortada('PrincipalN'); ?>"
                alt="Libros"></a>
          </div>
          <div class="bg-[#7a1b1b] p-4">
            <a class="font-bold text-white no-underline">Quiero leer un libro</a>
          </div>
        </div>

        <div
          class="w-full s max-w-[300px] overflow-hidden rounded-[15px] bg-white shadow-[0_4px_10px_rgba(0,0,0,0.1)] transition-transform hover:-translate-y-[5px]">
          <div>
            <a href="generos_peliculas.php"><img class="h-auto w-full" src="<?= $db->getImagenPortada('PrincipalP'); ?>"
                alt="Películas"></a>
          </div>
          <div class="bg-[#7a1b1b] p-4">
            <a class="font-bold text-white no-underline">Quiero ver una película</a>
          </div>
        </div>
      </div>
      <div class="hidden md:block">
        <img src="imagenes/ornamento2.png" alt="" class="m-2.5 w-[150px]">
      </div>

    </section>

    <div class="relative z-[3] bg-[#a76a3f9d] bg-cover p-[5vh] text-center text-[3vh] italic text-[#7a1b1b]">
      <h3>Recomendaciones</h3>
    </div>

    <section>
      <div class="px-10 py-10 text-center text-2xl italic text-[#524343]">
        <p>Encuentra tu nuevo libro o película favoritos</p>
      </div>

      <div id="recomendaciones" class=" bg-[#e3d0b6] m-0 flex flex-wrap justify-center gap-[60px] p-[5%]">
        <?php foreach ($materiales as $mat): ?>
          <?php $idEnlace = ($mat->id % 2 == 0) ? ($mat->id - 1) : $mat->id; ?>
          <div
            class="w-[200px] cursor-pointer rounded-[20px] bg-[#ffe9c4] pb-2.5 shadow-[10px_15px_40px_rgba(0,0,0,0.338)] transition-transform duration-300 hover:scale-110 lg:w-[calc(25%-15px)]">
            <a href="romancepareja.php?id=<?= $idEnlace; ?>">
              <img class="block h-auto w-full rounded-t-[20px] object-cover" src="<?= $mat->imagen; ?>"
                alt="<?= $mat->titulo; ?>">
            </a>
            <div class="pt-[5%] felx justify-center items-center text-center text-base">
              <p class="bg-[#e3ceaf] ml-20 mr-20 rounded-2xl text-brown"><?= $mat->tipo . " - " . $mat->anio; ?></p>
              <p class="text-brown"><strong><?= $mat->titulo; ?></strong></p>
              <p><?= $mat->autor; ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>

    <section class="flex justify-center p-[5%]">
      <img src="imagenes/ornamento3.png" alt="" class="w-[60%] md:w-[40%]">
    </section>

    <footer class="bg-[#2d2d2d] px-20 pt-10 text-base  text-[#f1f1f1] max-md:px-8">
      <div
        class="flex flex-col flex-wrap items-start justify-between gap-[30px] border-b border-[#888] pb-[30px] md:flex-row">
        <div class="flex min-w-[220px] flex-1 items-center gap-[15px]">
          <img src="imagenes/diseno-de-logo.png" alt="Logo by Diego Ciro & Luz Bietti" class="h-auto w-[70px]">
          <p class="text-[15px] font-medium leading-tight">BY DIEGO<br>CIRO &<br>LUZ BIETTI</p>
        </div>

        <div class="min-w-[200px] flex-1">
          <h3 class="mb-2.5 font-semibold text-white"></h3>
          <p class="leading-normal text-[#d1d1d1]">
            IES Tetuán de las victorias<br>
            Tel 999 999 999<br>
            <a class="text-[#d1d1d1] no-underline hover:underline">email@gmail.com</a>
          </p>
        </div>
      </div>

      <div class="flex items-center justify-start py-5">
        <div class="flex items-center gap-[15px]">
          <p class="m-0 text-lg text-[#f1f1f1]">Redes Sociales</p>
          <div class="flex gap-3">
            <a href="#"><img class="h-[25px] w-[25px] invert transition-opacity hover:opacity-70"
                src="imagenes/facebook.png" alt="Facebook"></a>
            <a href="#"><img class="h-[25px] w-[25px] invert transition-opacity hover:opacity-70"
                src="imagenes/instagram.png" alt="Instagram"></a>
            <a href="#"><img class="h-[25px] w-[25px] invert transition-opacity hover:opacity-70"
                src="imagenes/linkedin.png" alt="LinkedIn"></a>
          </div>
        </div>
      </div>
    </footer>

  </main>

  <div id="logoutModal" class="fixed inset-0 z-[999] hidden items-center justify-center bg-black/70 px-4">
    <div class="w-full max-w-md rounded-2xl bg-[#fff3df] p-8 text-center text-[#3b2f2f] shadow-2xl">
      <h2 class="mb-3 text-3xl font-bold text-[#7a1b1b]">Cerrar sesión</h2>
      <p class="mb-6 text-lg">¿Seguro que deseas cerrar sesión?</p>
      <div class="flex justify-center gap-4">
        <button id="cancelLogout" type="button"
          class="rounded-lg bg-[#d8c2a1] px-5 py-2 font-bold hover:bg-[#c7ad88]">Cancelar</button>
        <a id="confirmLogout" href="auth/login.php?logout=1"
          class="rounded-lg bg-[#7a1b1b] px-5 py-2 font-bold text-white no-underline hover:bg-[#a05a44]">Cerrar
          sesión</a>
      </div>
    </div>
  </div>
  <script>
    const logoutModal = document.getElementById('logoutModal');
    const cancelLogout = document.getElementById('cancelLogout');

    document.querySelectorAll('.logout-link').forEach((link) => {
      link.addEventListener('click', (e) => {
        e.preventDefault();
        if (!logoutModal) return;
        logoutModal.classList.remove('hidden');
        logoutModal.classList.add('flex');
      });
    });

    if (cancelLogout && logoutModal) {
      cancelLogout.addEventListener('click', () => {
        logoutModal.classList.add('hidden');
        logoutModal.classList.remove('flex');
      });
    }
  </script>
  <script src="assets/js/mejoras_ui.js"></script>
</body>

</html>