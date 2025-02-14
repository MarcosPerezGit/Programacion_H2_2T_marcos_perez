<?php
require_once '../config/class_conexion.php';

class Usuario {
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    // Verificamos si el correo ya existe
    public function correoExistente($correo) {
        $query = "SELECT * FROM usuarios WHERE correo = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->num_rows > 0;
    }

    // Agregamos un nuevo usuario
    public function agregarUsuario($nombre_usuario, $correo, $contraseña) {
        $validacionCorreo=$this->correoExistente($correo);
        if ($validacionCorreo){return false;}
        else{

        // Hasheamos la contraseña
        $hashed = password_hash($contraseña, PASSWORD_DEFAULT);

        // Insertamos el usuario
        $query = "INSERT INTO usuarios (nombre_usuario, correo, contraseña) VALUES (?, ?, ?)";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("sss", $nombre_usuario, $correo, $hashed);

        if ($stmt->execute()) {
            return true;
        } else {
            error_log("Error al agregar usuario: " . $stmt->error);
            return false;
        }
    }
}

    // Obtenemos usuarios por correo
    public function obtenerUsuarioPorCorreo($correo) {
        $query = "SELECT * FROM usuarios WHERE correo = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Obtenemos todos los usuarios
    public function obtenerUsuarios() {
        $query = "SELECT * FROM usuarios";
        $resultado = $this->conexion->conexion->query($query);
        $usuarios = [];
        while ($fila = $resultado->fetch_assoc()) {
            $usuarios[] = $fila;
        }
        return $usuarios;
    }

    // Eliminamos un usuario
    public function eliminarUsuario($id_usuario) {
        $query = "DELETE FROM usuarios WHERE id_usuario = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $id_usuario);
        return $stmt->execute();
    }
}
?>
