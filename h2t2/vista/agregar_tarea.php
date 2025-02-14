<?php
session_start(); 

// Iniciamos la sesion para gestionar la autenticacion del usuario y verificamos si esta autenticado.
// Si no tiene una sesion activa, lo redirigimos a la pagina de login.

require_once '../controlador/TareasController.php'; 

// Incluimos el controlador de tareas, que se encargara de la logica para gestionar las tareas.

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

// Creamos una instancia del controlador de tareas y definimos variables para manejar mensajes de exito o error.

$controller = new TareasController();
$error_message = '';
$success_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") { 

    // Si el formulario fue enviado por metodo POST, obtenemos la descripcion de la tarea y el ID del usuario.

    $descripcion = $_POST['descripcion'];
    $id_usuario = $_SESSION['id_usuario'];

    // Intentamos agregar la tarea con el controlador y guardamos el mensaje correspondiente.

    if ($controller->agregarTarea($id_usuario, $descripcion)) {
        $success_message = "Tarea agregada con exito.";
    } else {
        $error_message = "Error al agregar la tarea.";
    }
}


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Agregar Nueva Tarea</h2>
        <?php if ($error_message): ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <?php if ($success_message): ?>
            <div class="alert alert-success"><?php echo $success_message; ?></div>
        <?php endif; ?>
        <form action="agregar_tarea.php" method="POST" class="row g-3">
            <div class="col-md-12">
                <label for="descripcion" class="form-label">Descripción de la Tarea</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
            </div>
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary">Agregar Tarea</button>
                <a href="lista_tareas.php" class="btn btn-secondary">Volver a la Lista</a>
            </div>
        </form>
    </div>
</body>
</html>