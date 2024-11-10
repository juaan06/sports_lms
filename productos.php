<?php
include "./conexion.php";

// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $categoria = $_POST['categoria'];
    $precio = $_POST['precio'];

    // Comprobar si se ha subido una imagen
    if ($_FILES['imagen']['error'] == 0) {
        $imagen = file_get_contents($_FILES['imagen']['tmp_name']); // Leer el archivo de imagen
        $imagen = addslashes($imagen); // Escapar caracteres especiales
    } else {
        $imagen = null; // No hay imagen
    }

    // Insertar el producto en la base de datos
    $sql = "INSERT INTO productos (nombre, categoria, precio, imagen) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssds", $nombre, $categoria, $precio, $imagen);
    $stmt->execute();
    $stmt->close();
}

// Obtener productos de la base de datos para mostrar en la vista
$query = "SELECT id, nombre, categoria, precio, imagen FROM productos";
$resultado = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php include_once("./navbar.php");?>
<div class="container mt-5">
    <div class="row">
        <!-- Formulario para agregar producto -->
        <div class="col-md-6">
            <h4 class="text-center">Agregar Nuevo Producto</h4>
            <form action="productos.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nombre">Nombre del Producto:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="categoria">Categoría:</label>
                    <input type="text" name="categoria" id="categoria" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="precio">Precio:</label>
                    <input type="number" name="precio" id="precio" class="form-control" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="imagen">Imagen del Producto:</label>
                    <input type="file" name="imagen" id="imagen" class="form-control-file" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Subir Producto</button>
            </form>
        </div>

        <!-- Vista de productos ya registrados -->
        <div class="col-md-6">
            <h4 class="text-center">Productos Registrados</h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Imagen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($fila = mysqli_fetch_assoc($resultado)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($fila['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($fila['categoria']); ?></td>
                            <td><?php echo htmlspecialchars(number_format($fila['precio'], 2)); ?></td>
                            <td>
                                <?php if ($fila['imagen']): ?>
                                    <?php
                                        // Obtener el tipo de contenido de la imagen desde la base de datos (deberías tenerlo en tu consulta)
                                        $tipoImagen = 'image/jpeg'; // Ejemplo: reemplaza esto con el tipo real de la imagen que tienes en la base de datos
                                        $contenidoImagen = base64_encode($fila['imagen']);
                                    ?>
                                    
                                    <?php if (strpos($tipoImagen, 'image/') === 0): ?>
                                        <!-- Si es una imagen -->
                                        <img src="data:<?php echo $tipoImagen; ?>;base64,<?php echo $contenidoImagen; ?>" alt="Imagen del Producto" style="width: 50px; height: 50px;">
                                    <?php elseif ($tipoImagen === 'application/pdf'): ?>
                                        <!-- Si es un PDF -->
                                        <a href="data:application/pdf;base64,<?php echo $contenidoImagen; ?>" target="_blank">Ver PDF</a>
                                    <?php else: ?>
                                        <!-- Otros tipos de archivos -->
                                        <span>Archivo no soportado</span>
                                    <?php endif; ?>
                                <?php else: ?>
                                    Sin imagen
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>