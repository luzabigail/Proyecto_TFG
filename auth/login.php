<?php
session_start();

require_once __DIR__ . '/../app/config.php';
require_once __DIR__ . '/../app/auth/Usuario.php';
require_once __DIR__ . '/../app/auth/Auth.php';
require_once __DIR__ . '/../app/AccesoDatos.php';

if (isset($_GET['logout'])) {
    Auth::logout();
}

if (isset($_GET['redirigir'])) {
    $_SESSION['retorno'] = $_GET['redirigir'];
}

$error = "";
$registroOk = isset($_GET['registro']) && $_GET['registro'] === 'ok';

if ($_POST) {
    $usuario = new Usuario();
    $user = $usuario->login($_POST['usuario'], $_POST['password']);

    if ($user) {
        Auth::iniciarSesion($user);

        if (isset($_SESSION['retorno'])) {
            $destino = $_SESSION['retorno'];
            unset($_SESSION['retorno']);
            header("Location: ../" . $destino);
            exit;
        }

        header('Location: ../index.php');
        exit;
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="../assets/css/estilos_iniciar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Upright:wght@300;400;500;600;700&family=Dancing+Script:wght@400..700&family=Fleur+De+Leah&family=Fredoka:wght@300..700&family=Goudy+Bookletter+1911&family=Libre+Baskerville:ital,wght@0,400..700;1,400..700&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Tangerine:wght@400;700&family=Updock&display=swap"
        rel="stylesheet">
</head>

<body>


    <?php if ($registroOk): ?>
        <div class="notificacion exito">Usuario registrado correctamente. Ya puedes iniciar sesión.</div>
    <?php endif; ?>

    <div class="grid">
        <div class="fondo_verde">
            <h1>Inicie sesión en su cuenta</h1>

            <?php if ($error): ?>
                <div class="notificacion error"><?= htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <form action="" method="post">
                <div class="inputs">
                    <div><input name="usuario" type="text" placeholder="Usuario" required></div>
                    <div><input name="password" type="password" placeholder="Contraseña" required></div>
                </div>
                <div class="checkbox">
                    <div><input type="checkbox"><label for=""> Recordarme</label></div>
                    <div><a id="enlace" href="">¿Olvidó su contraseña?</a></div>
                </div>
                <div class="boton"><button id="boton" type="submit">Entrar</button></div>
            </form>
            <div class="iniciecon">
                <div>
                    <hr>
                </div>
                <div>
                    <p> ¿Aún no tienes cuenta? </p>
                </div>
                <div>
                    <hr>
                </div>
            </div>
            <div class="no">
                <div><a href="registro.php">No tengo cuenta</a></div>
                <div><a id="volvermenu" href="../index.php"><img src="../imagenes/flecha-izquierda.png" alt="">Volver
                        al
                        menú
                        principal</a></div>
            </div>

        </div>

    </div>
</body>

</html>