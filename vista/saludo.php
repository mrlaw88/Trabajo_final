<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Barra de navegación con Bootstrap</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS y Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        .navbar {
            background-color: #C0CDBE;
            /* Gris claro */
            border-bottom: 1px solid #000000;
            /* Borde negro de 5px */
        }

        body {
            margin-top: 70px;
            /* Ajuste para evitar que el contenido se solape con la barra de navegación fija */
        }

        .cerrarSesion .nav-link:hover {
            text-shadow: 0 0 10px red;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const logoutLink = document.querySelector('a.nav-link[href="http://20.19.37.89//vista/funciones/cerrarSesionProceso.php"]');
            
            logoutLink.addEventListener("click", function (event) {
                const confirmed = confirm("¿Estás seguro de que quieres salir de la sesión?");
                if (!confirmed) {
                    event.preventDefault();
                }
            });
        });
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Estudiofit (GymSyncElite)</a>
            <p class="navbar-text mx-auto d-lg-none">Bienvenido <?= $nombre ?><br> Tipo usuario: <?= $tipo_usuario ?></p>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="http://20.19.37.89//index.php">Inicio <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://20.19.37.89//vista/horario.php">Horario</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://20.19.37.89//vista/perfilUsuario.php">Perfil</a>
                    </li>
                    <li class="nav-item cerrarSesion">
                        <a class="nav-link" href="http://20.19.37.89//vista/funciones/cerrarSesionProceso.php">Cerrar sesión</a>
                    </li>
                </ul>
            </div>
            <p class="navbar-text d-none d-lg-block">Bienvenido <?= $nombre ?> Tipo usuario: <?= $tipo_usuario ?></p>
        </div>
    </nav>
</body>

</html>
