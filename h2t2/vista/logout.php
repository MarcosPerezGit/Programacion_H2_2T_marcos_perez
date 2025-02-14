<?php
session_start();

// Destruimos la sesion
session_destroy();

// Redirigimos al usuario a la pagina de inicio
header("Location: ../index.php");
exit();
?>