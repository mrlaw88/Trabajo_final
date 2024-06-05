<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Pago</title>
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
<body>
<?php
include "conexion.php";
include "fecha.php";

// Recuperar datos del formulario
$id_cliente = $_POST["id_cliente"];
$fecha_pago = $_POST['fecha_pago'];
$cantidad_pagada = $_POST['cantidad_pagada'];
$fecha_fin = date('Y-m-d', strtotime($fecha_pago . ' +1 month'));
$forma_pago = $_POST['forma_pago'];

// Insertar el pago en la base de datos
$sql_pago = "INSERT INTO pagos (id_cliente, fecha_pago, cantidad_pagada, fecha_fin, forma_pago) 
             VALUES ('$id_cliente', '$fecha_pago', '$cantidad_pagada', '$fecha_fin', '$forma_pago')";
$resultado_pago = mysqli_query($conexion, $sql_pago);

if ($resultado_pago === true) {
?>
    <div class='container contenedor'>
        <h1>Pago registrado exitosamente</h1>
        <div class='table-responsive'>
            <table class='table table-bordered table-hover styled-table'>
                <thead>
                    <tr>
                        <th colspan='2'>Detalles del Pago</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>ID Cliente:</th>
                        <td><?php echo $id_cliente; ?></td>
                    </tr>
                    <tr>
                        <th>Fecha de Pago:</th>
                        <td><?php echo $fecha_pago; ?></td>
                    </tr>
                    <tr>
                        <th>Cantidad Pagada:</th>
                        <td><?php echo $cantidad_pagada; ?></td>
                    </tr>
                    <tr>
                        <th>Fecha de Fin:</th>
                        <td><?php echo $fecha_fin; ?></td>
                    </tr>
                    <tr>
                        <th>Forma de Pago:</th>
                        <td><?php echo $forma_pago; ?></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <div class='centered-button'>
                <button onclick="window.location.href='../index.php'" class='btn btn-primary'>Volver al Index</button>
            </div>
        </div> <!-- Cierre de la tabla responsive -->
    </div> <!-- Cierre del contenedor -->
<?php
} else {
    echo "Error al registrar el pago: " . mysqli_error($conexion);
?>
    <br>
    <p>[ <a href='../index.php'>Volver al Index</a> ]</p>
<?php
}

// Cerrar la conexión
mysqli_close($conexion);
?>
</body>
</html>
