<?php

require_once __DIR__ . '/../AccesoDatos.php';

class Usuario {
    private $db;

    public function __construct() {
        $this->db = AccesoDatos::getModelo()->getConexion();
    }

public function registrar($usuario, $email, $password) {
        $reg = "INSERT INTO usuarios (usuario, email, password) VALUES (?, ?, ?)";
        return $this->db->prepare($reg)->execute([
            $usuario, $email, password_hash($password, PASSWORD_DEFAULT)
        ]);
    }

public function login($usuario, $password) {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $stmt->execute([$usuario]);
        
        $user = $stmt->fetchObject(); 

        if ($user && password_verify($password, $user->password)) {
            return $user;
        }
        return false;
    }
}
