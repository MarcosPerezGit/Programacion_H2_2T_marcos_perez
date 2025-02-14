<?php
session_start();
require_once '../controlador/TareasController.php';
$controller = new TareasController();

// Iniciamos la sesion y cargamos el controlador de tareas para gestionar las acciones del usuario.

// Verificamos si el usuario esta autenticado, si no, lo redirigimos al login.
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

// Si la accion es 'completar' y se ha recibido un id de tarea, intentamos marcarla como completada.
if (isset($_GET['action']) && $_GET['action'] == 'completar' && isset($_GET['id_tarea'])) {
    $id_tarea = intval($_GET['id_tarea']); // Convertimos el id a entero por seguridad

    if ($controller->marcarTareaCompletada($id_tarea, 'completada')) {
        header("Location: lista_tareas.php"); // Redirigimos para actualizar la lista de tareas
        exit();
    } else {
        $error_message = "Error al marcar la tarea como completada.";
    }
}

// Si la accion es 'eliminar' y se ha recibido un id de tarea, intentamos eliminarla.
if (isset($_GET['action']) && $_GET['action'] == 'eliminar' && isset($_GET['id_tarea'])) {
    $id_tarea = intval($_GET['id_tarea']); // Convertimos el id a entero por seguridad

    if ($controller->eliminarTarea($id_tarea)) {
        header("Location: lista_tareas.php"); // Redirigimos para actualizar la lista de tareas
        exit();
    } else {
        $error_message = "Error al eliminar la tarea.";
    }
}

// Obtenemos las tareas del usuario autenticado para mostrarlas en la interfaz.
$id_usuario = $_SESSION['id_usuario'];
$tareas = $controller->obtenerTareasPorUsuario($id_usuario);
?>

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Tareas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Lista de Tareas</h2>
        <a href="agregar_tarea.php" class="btn btn-primary mb-3">Agregar Nueva Tarea</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tareas as $tarea): ?>
                    <tr>
                    <td><?= htmlspecialchars($tarea['descripcion']) ?></td>
                    <td><?= htmlspecialchars($tarea['completada']) ?></td>
                        <td>
                            <?php if ($tarea['completada'] !== 'Completada') : ?>
                                <a href="?action=completar&id_tarea=<?= $tarea['id_tarea'] ?>" class="btn btn-success">
                                Marcar como Completada
                                </a>
                            <?php endif; ?>

                            <!-- Enlace para eliminar -->
                            <a href="?action=eliminar&id_tarea=<?= $tarea['id_tarea'] ?>" class="btn btn-danger">
                            Eliminar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="logout.php" class="btn btn-warning">Cerrar Sesión</a>
    </div>
</body>
</html>