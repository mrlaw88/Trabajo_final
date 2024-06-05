<head>
    <meta charset="UTF-8">
    <title>Consulta de clientes</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            padding: 20px;
            background-color: #f8f9fa;
        }

        .contenedor {
            max-width: 900px;
            margin-top: 100px;
        }

        h1 {
            margin-bottom: 20px;
            text-align: center;
        }

        .table th,
        .table td {
            vertical-align: middle;
            text-align: center;
        }

        .table-bordered th,
        .table-bordered td {
            border-width: 2px;
        }

        .styled-table th,
        .styled-table td {
            border-color: #dee2e6;
        }

        .styled-table thead th {
            background-color: #007bff;
            color: #ffffff;
        }

        .btn-primary,
        .btn-secondary {
            border-radius: 20px;
        }

        .btn-primary:hover,
        .btn-secondary:hover {
            background-color: #0056b3;
        }

        .centered-button {
            text-align: center;
        }
    </style>
</head>
<?php
include("../conexion.php");

if (isset($_POST['modificar'])) {
    $idCliente = $_POST['idCliente'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $email = $_POST['email'];

    if (empty($nombre) || empty($apellidos) || empty($fecha_nacimiento) || empty($email)) {
        echo "Todos los campos marcados con (*) son obligatorios.";
    } else {
        // Realizar la actualización en la base de datos
        $sqlUpdate = "UPDATE clientes SET nombre='$nombre', apellidos='$apellidos', fecha_nacimiento='$fecha_nacimiento', email='$email' WHERE id=$idCliente";

        if (mysqli_query($conexion, $sqlUpdate)) {
?>
            <div class='container contenedor'>
                <h1>Cliente modificado exitosamente</h1>
                <div class='table-responsive'>
                    <table class='table table-bordered table-hover styled-table'>
                        <thead>
                            <tr>
                                <th colspan='2'>Datos Modificados</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>ID:</th>
                                <td><?php echo $idCliente; ?></td>
                            </tr>
                            <tr>
                                <th>Nombre:</th>
                                <td><?php echo $nombre; ?></td>
                            </tr>
                            <tr>
                                <th>Apellidos:</th>
                                <td><?php echo $apellidos; ?></td>
                            </tr>
                            <tr>
                                <th>Fecha de Nacimiento:</th>
                                <td><?php echo $fecha_nacimiento; ?></td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td><?php echo $email; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <div class='centered-button'>
                        <button onclick="window.location.href='../../index.php'" class='btn btn-primary'>Volver al Index</button>
                    </div>
                </div> <!-- Cierre de la tabla responsive -->
            </div> <!-- Cierre del contenedor -->
<?php
        } else {
            echo "Error al modificar el cliente: " . mysqli_error($conexion);
?>
            <br>
            <p>[ <a href='../index.php'>Volver al Index</a> ]</p>
<?php
        }
    }
}

// Cerrar la conexión
mysqli_close($conexion);
?>
