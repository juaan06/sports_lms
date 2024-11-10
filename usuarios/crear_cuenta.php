<?php
// Incluir el archivo de conexión
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $clave = $_POST['clave'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];

    // Verificar si el correo ya existe
    $sql = "SELECT * FROM usuarios WHERE correo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<div class='alert alert-danger text-center' role='alert'>El correo electrónico ya está registrado. Por favor, utiliza otro.</div>";
    } else {
        // Insertar nuevo usuario en la base de datos
        $sql = "INSERT INTO usuarios (correo, clave, nombre, telefono) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $correo, $clave, $nombre, $telefono);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success text-center' role='alert'>Cuenta creada exitosamente. <a href='iniciar_sesion.php'>Iniciar sesión</a></div>";
        } else {
            echo "<div class='alert alert-danger text-center' role='alert'>Error al crear la cuenta. Inténtalo de nuevo.</div>";
        }
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Crear Cuenta</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="crear_cuenta.php">
                        <div class="form-group">
                            <label for="email">Correo Electrónico:</label>
                            <input type="email" name="correo" id="correo" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña:</label>
                            <input type="password" name="clave" id="clave" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Telefono:</label>
                            <input type="number" name="telefono" id="telefono" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Crear Cuenta</button>
                    </form>
                    <a href="../login.php" class="btn btn-secondary btn-block mt-3">Regresar a Iniciar Sesión</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
