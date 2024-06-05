<?php
include "sesion.php";
include "conexion.php";
include "./funciones/fecha.php";
include "saludo.php";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Historial de Pagos</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            padding: 20px;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 900px;
        }

        h1 {
            margin-bottom: 20px;
            color: #333;
        }

        .table{
            margin-top: 50px;
        }

        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }

        table th{
            color: #f8f9fa;
        }

        .table-bordered th, .table-bordered td {
            border-width: 2px; 
        }

        .btn-primary, .btn-secondary {
            border-radius: 20px;
        }

        .btn-primary:hover, .btn-secondary:hover {
            background-color: #0056b3;
        }

        .note {
            color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center">Historial de Pagos</h1>
        <?php
        $instruccion_pagos = "SELECT *
                              FROM clientes
                              JOIN pagos ON clientes.id = pagos.id_cliente
                              WHERE clientes.email = '$email'";
        $consulta_pagos = mysqli_query($conexion, $instruccion_pagos);

        if ($consulta_pagos === false) {
            echo "<div class='alert alert-danger'>Error en la consulta de pagos.</div>";
        } else {
            $nfilas_pagos = mysqli_num_rows($consulta_pagos);

            if ($nfilas_pagos > 0) {
                ?>
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID Pago</th>
                            <th>Fecha de Pago</th>
                            <th>Fecha Fin</th>
                            <th>Cantidad</th>
                            <th>Forma de Pago</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($pago = mysqli_fetch_assoc($consulta_pagos)) {
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($pago['id_pago'], ENT_QUOTES, 'UTF-8'); ?></td> 
                                <td><?php echo date2string($pago['fecha_pago']); ?></td>
                                <td><?php echo date2string($pago['fecha_fin']); ?></td>
                                <td><?php echo htmlspecialchars($pago['cantidad_pagada'], ENT_QUOTES, 'UTF-8'); ?></td> 
                                <td><?php echo htmlspecialchars($pago['forma_pago'], ENT_QUOTES, 'UTF-8'); ?></td> 
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            <?php
            } else {
                echo "<div class='alert alert-info'>El usuario no ha realizado pagos.</div>";
            }
        }

        // Cerrar conexión
        mysqli_close($conexion);
        ?>
    </div>

    <!-- Bootstrap JS y Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
