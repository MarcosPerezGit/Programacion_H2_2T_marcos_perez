<?php
require_once '../modelo/class_tarea.php';

class TareasController {
    private $tarea;

    public function __construct() {
        $this->tarea = new Tarea();
    }

    // Agregamos una nueva tarea
    public function agregarTarea($id_usuario, $descripcion) {
        return $this->tarea->agregarTarea($id_usuario, $descripcion);
    }

    // Obtenemos todas las tareas de un usuario
    public function obtenerTareasPorUsuario($id_usuario) {
        return $this->tarea->obtenerTareasPorUsuario($id_usuario);
    }

    // Marcamos una tarea como completada
    public function marcarTareaCompletada($id_tarea,$completada) {
        return $this->tarea->marcarTareaCompletada($id_tarea,$completada);
    }

    // Eliminamos una tarea
    public function eliminarTarea($id_tarea) {
        return $this->tarea->eliminarTarea($id_tarea);
    }
}
?>