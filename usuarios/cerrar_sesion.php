<?php
// cerrar_sesion.php
session_start();

// Elimina todas las variables de sesión
session_unset();

// Destruye la sesión
session_destroy();

// Redirige al usuario a la página de inicio de sesión
header("Location: http://localhost/shari/index.php");
exit();
?>
