<?php

require_once '../modelo/class_usuario.php';

class UsuariosController {
    private $usuario;

    public function __construct() {
        require_once '../modelo/class_usuario.php';
        $this->usuario = new Usuario();
    }

    // Registramos un usuario
    public function agregarUsuario($nombre_usuario, $correo, $contraseña) {
        return $this->usuario->agregarUsuario($nombre_usuario, $correo, $contraseña);
    }

    // Obtenemos usuarios por correo
    public function obtenerUsuarioPorCorreo($correo) {
        return $this->usuario->obtenerUsuarioPorCorreo($correo);
    }

    // Obtenemos todos los usuarios
    public function obtenerUsuarios() {
        return $this->usuario->obtenerUsuarios();
    }

    // Eliminamos un usuario
    public function eliminarUsuario($id_usuario) {
        return $this->usuario->eliminarUsuario($id_usuario);
    }
}
?>
