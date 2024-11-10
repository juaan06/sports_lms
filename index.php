<?php
session_start();
include 'conexion.php';

$nombreUsuario = "Invitado"; // Nombre por defecto si no hay sesión activa

// Si el usuario ha iniciado sesión, obtenemos su nombre
if (isset($_SESSION['correo'])) {
    $correo = $_SESSION['correo'];
    $query = "SELECT nombre FROM usuarios WHERE correo = '$correo'";
    $resultado = mysqli_query($conn, $query);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);
        $nombreUsuario = $fila['nombre'];
    }
}
?>
<body>
    <style>
.carousel-control-prev,
.carousel-control-next {
    width: 50px; /* Ancho del botón */
    height: auto; /* Altura del botón */
    background-color: rgba(0, 0, 0, 0.5); /* Fondo semitransparente */
    border-radius: 50%; /* Botones circulares */
    top: 50%; /* Posicionarlos en el centro vertical */
    transform: translateY(-50%); /* Centrar verticalmente */
    z-index: 1; /* Asegúrate de que estén por encima de las imágenes */
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
    width: 20px; /* Tamaño del icono */
    height: 20px; /* Tamaño del icono */
}
#slider {
    position: relative; /* Asegúrate de que el contenedor sea relativo */
}
.carousel-inner {
    background-color: #808080;
}
img {
    width: 100%; /* Asegúrate de que la imagen ocupe todo el ancho del contenedor */
    height: auto; /* Mantiene la proporción de la imagen */
    max-height: 400px; /* Limita la altura máxima de las imágenes */
    object-fit: contain; /* Asegura que la imagen se ajuste al contenedor sin recortarse */
}

    </style>
<?php include_once("./navbar.php");?>
<!-- Slider -->
<div id="slider" class="carousel slide mt-4" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="./img/baloncesto.jpg" class="d-block w-100" alt="Imagen 1">
        </div>
        <div class="carousel-item">
            <img src="./img/futbol.jpg" class="d-block w-100" alt="Imagen 2">
        </div>
        <div class="carousel-item">
            <img src="./img/tennis.jpg" class="d-block w-100" alt="Imagen 3">
        </div>
        </div>
        <div class="carousel-item">
            <img src="./img/voley2.jpg" class="d-block w-100" alt="Imagen 4">
        </div>
    </div>
</div>
<?php include_once("./footer.php");?>

<script>
    // Espera a que el documento esté completamente cargado
    document.addEventListener('DOMContentLoaded', function () {
        // Selecciona el carrusel
        var carousel = document.querySelector('#slider');

        // Inicializa el carrusel de Bootstrap
        var carouselInstance = new bootstrap.Carousel(carousel, {
            interval: 2000, // Cambia de slide cada 4 segundos (4000 ms)
            wrap: true // Permite que el carrusel vuelva al inicio al llegar al final
        });

        // Activa el carrusel inmediatamente
        carouselInstance.cycle();
    });
</script>
</body>
</html>
