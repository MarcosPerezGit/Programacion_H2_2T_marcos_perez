<?php
session_start();
require_once '../controlador/UsuariosController.php';

// Iniciamos la sesion y cargamos el controlador de usuarios para manejar el registro.

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $nombre_usuario = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    $controller = new UsuariosController();

    // Intentamos agregar el nuevo usuario con los datos proporcionados.
    $usuario = $controller->agregarUsuario($nombre_usuario, $correo, $contraseña);

    // Si el correo ya esta registrado, mostramos un mensaje de error.
    if (!$usuario) { 
        $error_message = "El correo que has introducido ya esta registrado.";
    } else { 
        // Si el usuario se registra correctamente, lo redirigimos a la pagina principal.
        header("location: ../index.php"); 
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow p-4">
                    <h2 class="text-center">Registro</h2>
                    <?php if (!empty($error_message)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= htmlspecialchars($error_message) ?>
                        </div>
                    <?php endif; ?>
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre de Usuario</label>
                            <input type="text" class="form-control" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" name="correo" required>
                        </div>
                        <div class="mb-3">
                            <label for="contraseña" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" name="contraseña" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Registrarse</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>