<?php

require_once __DIR__ . "/config.php";
require_once __DIR__ . "/Material.php";

class AccesoDatos {
    private static $modelo = null;
    private $dbh = null;

    public static function getModelo(){
        // Si no existe lo crea el acceso de a la BD
        if (self::$modelo == null){
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }

    public function getConexion() {
        return $this->dbh;
    }

    private function __construct(){
        try {
            $dsn = "mysql:host=".DB_SERVER.";dbname=".DATABASE.";charset=utf8";
            $this->dbh = new PDO($dsn,DB_USER, DB_PASSWD);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }
    }

    public function getMaterialesRand(): array {
        $lista = [];
        $stmt = $this->dbh->prepare("SELECT * FROM material ORDER BY RAND() LIMIT 6");
        $stmt->execute();
        while ($obj = $stmt->fetchObject('Material')) {
            $lista[] = $obj;
        }
        return $lista;
    }

    public function getImagenPortada($tipo): string {
        $stmt = $this->dbh->prepare("SELECT imagen FROM portadas WHERE tipo = ? LIMIT 1");
        $stmt->execute([$tipo]);
        $resultado = $stmt->fetchColumn();
        return $resultado;
    }

    public function getGeneros($tipoBase): array {
        $lista = [];
        $stmt = $this->dbh->prepare("SELECT * FROM portadas WHERE tipoBase = ?");
        $stmt->execute([$tipoBase]);
        while ($obj = $stmt->fetchObject()) {
            $lista[] = $obj;
        }
        return $lista;
    }

    public function getGenerosParejas($nombreGenero): array {
        $lista = [];
        $stmt = $this->dbh->prepare("SELECT * FROM material WHERE imagen LIKE ? ORDER BY id ASC");
        $stmt->execute(["%/$nombreGenero/%"]);
        while ($obj = $stmt->fetchObject('Material')) {
            $lista[] = $obj;
        }
        return $lista;
    }

    public function getParejaPorId($idLibro): array {
        $lista = [];
        $stmt = $this->dbh->prepare("SELECT * FROM material WHERE id = ? OR id = ? ORDER BY id ASC");
        $stmt->execute([$idLibro, $idLibro + 1]);
        while ($obj = $stmt->fetchObject('Material')) {
            $lista[] = $obj;
        }
        return $lista;
    }

    public function buscarMaterial($nombre): array {
        $lista = [];
        $stmt = $this->dbh->prepare("SELECT * FROM material WHERE titulo LIKE ?");
        $stmt->execute(["%$nombre%"]);
        while ($obj = $stmt->fetchObject('Material')) {
            $lista[] = $obj;
        }
        return $lista;
    }

    public function guardarComentario($id_material, $usuario, $valoracion, $texto) {
        $datos = "INSERT INTO comentarios (id_material, usuario, valoracion, texto) VALUES (?, ?, ?, ?)";
        $consulta = $this->dbh->prepare($datos);
        $consulta->execute([$id_material, $usuario, $valoracion, $texto]);
    }

    public function obtenerComentarios($id_material) {
        $datos = "SELECT id, id_material, usuario, valoracion, texto, DATE_FORMAT(fecha, '%d/%m/%Y') AS fechafinal
                  FROM comentarios WHERE id_material = ? ORDER BY fecha DESC";
        $consulta = $this->dbh->prepare($datos);
        $consulta->execute([$id_material]);
        return $consulta->fetchAll(PDO::FETCH_OBJ);
    }

    public function editarComentario($id_comentario, $usuario, $valoracion, $texto): bool {
        $datos = "UPDATE comentarios SET valoracion = ?, texto = ? WHERE id = ? AND usuario = ?";
        $consulta = $this->dbh->prepare($datos);
        $consulta->execute([$valoracion, $texto, $id_comentario, $usuario]);
        return $consulta->rowCount() > 0;
    }

    public function eliminarComentario($id_comentario, $usuario): bool {
        $datos = "DELETE FROM comentarios WHERE id = ? AND usuario = ?";
        $consulta = $this->dbh->prepare($datos);
        $consulta->execute([$id_comentario, $usuario]);
        return $consulta->rowCount() > 0;
    }

    public function guardarFav($usuario, $id_material) {
        if ($this->existeFav($usuario, $id_material)) {
            return;
        }
        $stmt = $this->dbh->prepare("INSERT INTO guardados (usuario, id_material) VALUES (?, ?)");
        $stmt->execute([$usuario, $id_material]);
    }

    public function existeFav($usuario, $id_material): bool {
        $stmt = $this->dbh->prepare("SELECT COUNT(*) FROM guardados WHERE usuario = ? AND id_material = ?");
        $stmt->execute([$usuario, $id_material]);
        return (int)$stmt->fetchColumn() > 0;
    }

    public function eliminarFav($usuario, $id_material): bool {
        $stmt = $this->dbh->prepare("DELETE FROM guardados WHERE usuario = ? AND id_material = ?");
        $stmt->execute([$usuario, $id_material]);
        return $stmt->rowCount() > 0;
    }

    public function mostrarFav($usuario): array {
        $lista = [];
        $stmt = $this->dbh->prepare("SELECT * FROM material WHERE id IN (SELECT id_material FROM guardados WHERE usuario = ?)");
        $stmt->execute([$usuario]);
        while ($obj = $stmt->fetchObject('Material')) {
            $lista[] = $obj;
        }
        return $lista;
    }
}
