<?php
session_start();
require_once __DIR__ . '/../app/config.php';
require_once __DIR__ . '/../app/auth/Usuario.php';
require_once __DIR__ . '/../app/AccesoDatos.php';
require_once __DIR__ . '/../app/auth/Auth.php';

$errores = [];
$usuarioValor = '';
$emailValor = '';

if ($_POST) {
    $usuarioValor = trim($_POST['usuario'] ?? '');
    $emailValor = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $passwordConfirmar = $_POST['password_confirmar'] ?? '';

    if ($usuarioValor === '')
        $errores[] = 'El usuario es obligatorio.';
    if (!filter_var($emailValor, FILTER_VALIDATE_EMAIL))
        $errores[] = 'Introduce un email válido.';
    if ($password !== $passwordConfirmar)
        $errores[] = 'Las contraseñas no coinciden.';
    if (strlen($password) < 8)
        $errores[] = 'La contraseña debe tener al menos 8 caracteres.';
    if (!preg_match('/[A-Z]/', $password))
        $errores[] = 'La contraseña debe incluir al menos una mayúscula.';
    if (!preg_match('/[^a-zA-Z0-9]/', $password))
        $errores[] = 'La contraseña debe incluir al menos un carácter especial.';

    if (!$errores) {
        try {
            $usuario = new Usuario();
            $usuario->registrar($usuarioValor, $emailValor, $password);
            header('Location: login.php?registro=ok');
            exit;
        } catch (PDOException $e) {
            $errores[] = 'No se pudo crear la cuenta. Revisa si el usuario ya existe.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear cuenta</title>
    <link rel="stylesheet" href="../assets/css/estilos_iniciar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Upright:wght@300;400;500;600;700&family=Dancing+Script:wght@400..700&family=Fleur+De+Leah&family=Fredoka:wght@300..700&family=Goudy+Bookletter+1911&family=Libre+Baskerville:ital,wght@0,400..700;1,400..700&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Tangerine:wght@400;700&family=Updock&display=swap"
        rel="stylesheet">
</head>

<body>
    <?php if ($errores): ?>
        <div class="notificacion error">
            <?php foreach ($errores as $error): ?>
                <p><?= htmlspecialchars($error); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="grid">
        <div class="fondo_verde">
            <h1>Crear cuenta</h1>
            <form action="" method="post">
                <div class="inputs">
                    <div><input name="usuario" type="text" placeholder="Usuario"
                            value="<?= htmlspecialchars($usuarioValor); ?>" required></div>
                    <div><input name="email" type="email" placeholder="Email"
                            value="<?= htmlspecialchars($emailValor); ?>" required></div>
                    <div><input name="password" type="password" placeholder="Contraseña" required></div>
                    <div><input name="password_confirmar" type="password" placeholder="Repite la contraseña" required>
                    </div>
                    <p class="ayuda-password">Mínimo 8 caracteres, una mayúscula y un carácter especial.</p>
                    <div class="botonregistro"><button id="botonregistro" type="submit">Registrarse</button></div>
                    <div id="no">
                        <a id="volvermenu" href="login.php"><img src="../imagenes/flecha-izquierda.png" alt="">Volver
                            al
                            menú
                            principal</a>

                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>