<?php
include("conexion.php");
include("sesion.php");
include("saludo.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Modificar cliente</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 20px;
            background-color: #f8f9fa;
        }

        .contenedor {
            max-width: 600px;
            margin-top: 100px;
        }

        .card {
            margin-top: 20px;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-bottom: 20px;
            color: #333;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .form-control {
            border-radius: 10px;
        }

        .note {
            color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="container contenedor">
        <div class="card">
            <h1 class="text-center">Modificar cliente</h1>

            <?php
            if (isset($_POST['idCliente'])) {
                $idCliente = $_POST['idCliente'];
            }

            $consultaModificar = "SELECT * FROM clientes WHERE id=$idCliente";
            $resultadoModificar = mysqli_query($conexion, $consultaModificar);

            if ($resultadoModificar && mysqli_num_rows($resultadoModificar) > 0) {
                $resultado1 = mysqli_fetch_assoc($resultadoModificar);
            ?>

                <form action="./funciones/funcionesModificar.php" name="modifica" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nombre: *</label>
                        <input type="text" class="form-control" name="nombre" value="<?= htmlspecialchars($resultado1['nombre'], ENT_QUOTES, 'UTF-8') ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Apellidos: *</label>
                        <input type="text" class="form-control" name="apellidos" value="<?= htmlspecialchars($resultado1['apellidos'], ENT_QUOTES, 'UTF-8') ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Fecha nacimiento</label>
                        <input type="date" class="form-control" name="fecha_nacimiento" value="<?= htmlspecialchars($resultado1['fecha_nacimiento'], ENT_QUOTES, 'UTF-8') ?>">
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" class="form-control" name="email" id="email" value="<?= htmlspecialchars($resultado1['email'], ENT_QUOTES, 'UTF-8') ?>" required>
                    </div>
                    <input type="hidden" name="idCliente" value="<?= htmlspecialchars($idCliente, ENT_QUOTES, 'UTF-8') ?>">

                    <button type="submit" name="modificar" class="btn btn-primary btn-block">Modificar cliente</button>
                </form>

            <?php
            } else {
                echo "<p class='text-center'>No se encontró el cliente.</p>";
            }
            ?>

            <p class="text-center note">NOTA: los datos marcados con (*) deben ser rellenados obligatoriamente</p>
            
        </div>
    </div>

    <!-- Bootstrap JS y Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
