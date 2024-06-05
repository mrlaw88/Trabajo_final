<?php
include "sesion.php";
include "saludo.php";
?>

<!DOCTYPE html>
<html lang="es">

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

        .btn-primary, .btn-secondary {
            border-radius: 20px;
        }
        
        .btn-primary:hover, .btn-secondary:hover {
            background-color: #0056b3;
        }

        .note {
            color: #6c757d;
        }

        .form-inline {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .form-inline input[type="submit"] {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center">Consulta de clientes</h1>

        <?php
        include("./funciones/fecha.php");
        include("conexion.php");

        $instruccion = "SELECT DISTINCT clientes.id, clientes.nombre, clientes.apellidos, clientes.fecha_alta, pagos.fecha_pago, pagos.fecha_fin, clientes.email
                        FROM clientes
                        LEFT JOIN pagos ON clientes.id = pagos.id_cliente
                        LEFT JOIN (
                            SELECT id_cliente, MAX(fecha_pago) AS ultima_fecha_pago
                            FROM pagos
                            GROUP BY id_cliente
                        ) ultima_pago ON clientes.id = ultima_pago.id_cliente
                        WHERE pagos.fecha_pago = ultima_pago.ultima_fecha_pago OR pagos.fecha_pago IS NULL;";
        $consulta = mysqli_query($conexion, $instruccion);

        if ($consulta == FALSE) {
            echo "<div class='alert alert-danger'>Error en la ejecución de la consulta.</div>";
        } else {
            $nfilas = mysqli_num_rows($consulta);
            if ($nfilas > 0) {
        ?>
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Fecha alta</th>
                            <th>Ultimo pago</th>
                            <th>Pagado hasta</th>
                            <th>Email</th>
                            <th>Modificar</th>
                            <th>Pagar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($resultado = mysqli_fetch_assoc($consulta)) {
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($resultado['nombre'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($resultado['apellidos'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo date2string($resultado['fecha_alta']); ?></td>
                                <td><?php echo date2string($resultado['fecha_pago']); ?></td>
                                <td><?php echo date2string($resultado['fecha_fin']); ?></td>
                                <td><?php echo htmlspecialchars($resultado['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <?php
                                if ($tipo_usuario == "admin") {
                                ?>
                                    <td>
                                        <form action="modificar_clientes.php" method="post" class="form-inline">
                                            <input type="hidden" name="idCliente" value="<?= htmlspecialchars($resultado['id'], ENT_QUOTES, 'UTF-8') ?>">
                                            <input type="submit" class="btn btn-primary" value="Modificar">
                                        </form>
                                    </td>
                                    <td>
                                        <form action="registroPagos.php" method="post" class="form-inline">
                                            <input type="hidden" name="idCliente" value="<?= htmlspecialchars($resultado['id'], ENT_QUOTES, 'UTF-8') ?>">
                                            <input type="submit" class="btn btn-secondary" value="Añadir pago">
                                        </form>
                                    </td>
                                <?php
                                }
                                ?>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            <?php
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
