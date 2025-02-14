<?php
require_once '../config/class_conexion.php';

class Tarea {
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    // Agregamos una nueva tarea
    public function agregarTarea($id_usuario, $descripcion) {
        $query = "INSERT INTO tareas (id_usuario, descripcion) VALUES (?, ?)";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("is", $id_usuario, $descripcion);
        return $stmt->execute();
    }

    // Obtenemos todas las tareas de un usuario
    public function obtenerTareasPorUsuario($id_usuario) {
        $query = "SELECT * FROM tareas WHERE id_usuario = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Marcamos una tarea como completada
    public function marcarTareaCompletada($id_tarea,$completada) {
        $query = "UPDATE tareas SET completada = ? WHERE id_tarea = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("si", $completada,$id_tarea);
        return $stmt->execute();
    }

    // Eliminamos una tarea
    public function eliminarTarea($id_tarea) {
        $query = "DELETE FROM tareas WHERE id_tarea = ?";
        $stmt = $this->conexion->conexion->prepare($query);
        $stmt->bind_param("i", $id_tarea);
        return $stmt->execute();
    }
}
?>