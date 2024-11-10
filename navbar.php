
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="http://localhost/shari/index.php">Logo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/shari/index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/shari/productos.php">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contacto</a>
                </li>
            </ul>
            <button class="btn btn-outline-light ms-2" id="btn-menu">Menú</button>
        </div>
    </div>
</nav>

<!-- Modal -->
<div class="modal fade" id="menuModal" tabindex="-1" aria-labelledby="menuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="menuModalLabel">Menú | <?php echo htmlspecialchars($nombreUsuario); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item"><a href="http://localhost/shari/usuarios/iniciar_sesion.php">Iniciar sesión</a></li>
                    <li class="list-group-item"><a href=" http://localhost/shari/usuarios/cerrar_sesion.php">Cerrar sesión</a></li>
                    <li class="list-group-item"><a href="#">Ayuda</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php include_once("./footer.php");?>
<!-- Scripts -->
<script>
    document.getElementById('btn-menu').addEventListener('click', function () {
        var menuModal = new bootstrap.Modal(document.getElementById('menuModal'));
        menuModal.show();
    });
</script>