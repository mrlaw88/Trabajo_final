<?php
include "vista/sesion.php";
include "vista/saludo.php";
include "vista/conexion.php";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Estudiofit (GymSyncElite)</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS y Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./css/gestionGim.css">

    <!-- Estilos personalizados -->
    <style>
        body {
            background-color: #E0F5CC; /* Verde pistacho claro */
            color: #333; /* Gris oscuro */
            padding-top: 56px;
        }

        .jumbotron {
            background-color: #A3DCA8; /* Verde pistacho */
            color: #333; /* Gris oscuro */
        }

        .card {
            background-color: #C5E1A5; /* Verde pistacho */
            color: #333; /* Gris oscuro */
        }

        .btn-primary {
            background-color: #8BC34A; /* Verde pistacho */
            border-color: #8BC34A; /* Verde pistacho */
        }

        .btn-primary:hover {
            background-color: #7CB342; /* Verde pistacho oscuro */
            border-color: #7CB342; /* Verde pistacho oscuro */
        }

        .footer {
            background-color: #333; /* Gris oscuro */
            color: #E0F5CC; /* Verde pistacho claro */
        }

        .box {
            border-radius: 15px;
            padding: 20px;
            background-color: #F1F8E9; /* Verde pistacho muy claro */
            border: 1px solid #CFD8DC; /* Gris claro */
            margin-bottom: 20px;
            text-align: center;
        }

        .btn-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .carousel-inner img {
            width: 100%;
            height: 400px;
        }

        div.active{
            background-color: #F1F8E9;
        }
    </style>
</head>

<body>

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="./img/gimlogo.png" alt="First slide" >
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="./img/gimnasio.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="./img/equipo.jpg" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <section id="menu" class="menu">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>EstudioFit</h2>
            </div>

            <div class="row">
                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div class="box" data-aos="zoom-in" data-aos-delay="100">
                        <span>Ver Horario</span>
                        <p>Aquí puedes reservar tu clase.</p>
                        <div class="btn-container">
                            <a href="./vista/horario.php" class="btn btn-primary">Reservar</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div class="box" data-aos="zoom-in" data-aos-delay="200">
                        <span>Consulta Pagos</span>
                        <p>Consulta detalladamente tus pagos.</p>
                        <div class="btn-container">
                            <a href="./vista/pagos.php" class="btn btn-primary">Ver</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div class="box" data-aos="zoom-in" data-aos-delay="300">
                        <span>Perfil</span>
                        <p>Consultar tus datos y/o modificarlos.</p>
                        <div class="btn-container">
                            <a href="./vista/perfilUsuario.php" class="btn btn-primary">Ver</a>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <?php
            if ($tipo_usuario == "admin") {
            ?>
                <h1>Panel Administrador</h1>
                <div class="row">
                    <div class="col-lg-2 mt-2 mt-lg-0"></div>
                    <div class="col-lg-4 mt-4 mt-lg-0">
                        <div class="box" data-aos="zoom-in" data-aos-delay="200">
                            <span>Ver Clientes</span>
                            <p>Aquí puedes consultar o modificar.</p>
                            <div class="btn-container">
                                <a href="./vista/mostrar_clientes.php" class="btn btn-primary">Ver</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 mt-4 mt-lg-0">
                        <div class="box" data-aos="zoom-in" data-aos-delay="300">
                            <span>Nuevo usuario</span>
                            <p>Crear nuevo usuario.</p>
                            <div class="btn-container">
                                <a href="./vista/nuevoUsuario.php" class="btn btn-primary">Ver</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 mt-2 mt-lg-0"></div>
                </div>
            <?php
            }
            ?>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="row mt-4">
                <div class="col-lg-4 mx-auto text-center">
                    <a href="https://www.facebook.com/SalaEstudioFit" target="_blank"><img src="./img/face.jfif" style="width: 25px; height: 25px; border-radius: 5px;"></a><br>
                    <a href="http://20.19.37.89//vista/avisolegal.php" target="_blank">Aviso Legal</a> |
                    <a href="https://maps.app.goo.gl/i3d29BA3X5tF9NLq9" target="_blank">Mapa Web</a> |
                    <a href="mailto:law.roca.alejandro@gmail.com?Subject=Interesado%20en%20el%20Estudiofit">Contacto</a> 
                    <p>Derechos Reservados &copy; 2024</p>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>
