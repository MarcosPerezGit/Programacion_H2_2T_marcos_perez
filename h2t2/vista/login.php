<?php
session_start();
require_once '../controlador/UsuariosController.php';
$controller = new UsuariosController();
$error_message = '';

// Iniciamos la sesion y cargamos el controlador de usuarios para manejar la autenticacion.

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    // Obtenemos el usuario por su correo para verificar sus credenciales.
    $usuario = $controller->obtenerUsuarioPorCorreo($correo);

    // Si el usuario existe y la contraseña es correcta, iniciamos la sesion y lo redirigimos.
    if ($usuario && password_verify($contraseña, $usuario['contraseña'])) {
        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        $_SESSION['nombre_usuario'] = $usuario['nombre_usuario'];
        header("Location: lista_tareas.php");
    } else {
        $error_message = "Correo o contraseña incorrectos."; 
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Iniciar Sesión</h2>
        <?php if ($error_message): ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <form action="login.php" method="POST" class="row g-3">
            <div class="col-md-6">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="correo" name="correo" required>
            </div>
            <div class="col-md-6">
                <label for="contraseña" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="contraseña" name="contraseña" required>
            </div>
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
            </div>
        </form>
    </div>
</body>
</html>