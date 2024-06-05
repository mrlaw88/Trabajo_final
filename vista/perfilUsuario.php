<?php
include "sesion.php";
include "saludo.php";
include "./funciones/fecha.php";
include "conexion.php";

?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Consulta de clientes</title>
    
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

        .btn-primary,
        .btn-secondary {
            border-radius: 20px;
        }

        .btn-primary:hover,
        .btn-secondary:hover {
            background-color: #0056b3;
        }

        .note {
            color: #6c757d;
        }

        .centrar {
            display: flex;
            justify-content: center;
        }
    </style>
</head>

<body>
    <div class="container contenedor">
        <h1>Consulta de clientes</h1>
        <?php
        $instruccion = "SELECT clientes.id, clientes.nombre, clientes.apellidos, clientes.fecha_alta, 
        MAX(pagos.fecha_pago) AS ultimo_pago, MAX(pagos.fecha_fin) AS hasta_cuando_pagado, clientes.email
 FROM clientes
 JOIN pagos ON clientes.id = pagos.id_cliente
 WHERE clientes.email = '$email'
 GROUP BY clientes.id
 ORDER BY ultimo_pago DESC;";
        $consulta = mysqli_query($conexion, $instruccion);
        
        if ($consulta == FALSE) {
            echo "<div class='alert alert-danger'>Error en la ejecución de la consulta.</div>";
          
        } else {
            // Mostrar resultados de la consulta
            
            $nfilas = mysqli_num_rows($consulta);
            if ($nfilas > 0) {
          
        ?>
                <table class="table table-bordered table-hover">
                    <?php
                    while ($resultado = mysqli_fetch_assoc($consulta)) {
                    ?>
                        <tr>
                            <th>Nombre:</th>
                            <td><?php echo $resultado['nombre']; ?></td>
                        </tr>
                        <tr>
                            <th>Apellidos:</th>
                            <td><?php echo $resultado['apellidos']; ?></td>
                        </tr>
                        <tr>
                            <th>Fecha alta:</th>
                            <td><?php echo date2string($resultado['fecha_alta']); ?></td>
                        </tr>
                        <tr>
                            <th>Ultimo pago:</th>
                            <td><?php echo date2string($resultado['ultimo_pago']); ?></td>
                        </tr>
                        <tr>
                            <th>Pagado hasta:</th>
                            <td><?php echo date2string($resultado['hasta_cuando_pagado']); ?></td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td><?php echo $resultado['email']; ?></td>
                        </tr>
                </table>


                <form action="modificar_clientes.php" method="post" class="centrar">
                    <input type="hidden" name="idCliente" value="<?= $resultado['id'] ?>">
                    <input type="submit" value="Modificar" class="btn btn-primary">
                </form>

    <?php

                    }
                } else {
                    echo "<div class='alert alert-info'>No hay clientes.</div>";
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