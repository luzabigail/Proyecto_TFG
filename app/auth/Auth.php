<?php
class Auth {


    public static function iniciarSesion($user) {

        $_SESSION['user_id'] = $user->id;
        $_SESSION['usuario'] = $user->usuario;
        $_SESSION['acceso'] = time(); //función propia, lo da en segundos  

    }

    public static function inactividad(){
        if (isset($_SESSION['user_id'])){
            $presente = time();
            $limite = 10*60; 

            if ($presente - $_SESSION['acceso'] > $limite) {
                // Si sobrepasa el limite le cierra la sesión 
                self::logout();
            } else {
                // Si no, actualizamos para que no se cierre obligatoriamente aunque el usuario interactue
                $_SESSION['acceso'] = $presente;
        }

    }
    
    }

    public static function logout() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start(); //inicia la sesión por que si no no cerrará nunca y da errores
    }
        session_destroy();
        header('Location: ../index.php'); //mandamos al inicio
        exit;
    }
}




