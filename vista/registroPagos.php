<?php
include "sesion.php";
include "saludo.php";
include "conexion.php";

$id_cliente = $_POST["idCliente"];

// Obtener la fecha actual y calcular la fecha de fin (suponiendo un mes de plazo)
$fecha_actual = date('Y-m-d');
$fecha_fin = date('Y-m-d', strtotime('+1 month', strtotime($fecha_actual)));
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Pago</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
            background-color: #f8f9fa;
        }

        .contenedor {
            max-width: 500px;
            margin-top: 100px;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        table {
            margin: 0 auto;
            margin-bottom: 10px;
            text-align: left;
            border-collapse: separate;
        }

        label {
            font-weight: bold;
        }

        input[type="date"],
        input[type="number"],
        select {
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            margin-top: 5px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            background-color: #007bff;
            border: none;
            color: #fff;
            cursor: pointer;
            margin-top: 10px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container contenedor">
    <h2>Registro de Pago un mes</h2>
    <table class="table table-bordered">
        <form action="procesar_pago.php" method="post">
            <!-- Agregando el campo id_cliente oculto -->
            <input type="hidden" name="id_cliente" value="<?php echo $id_cliente; ?>">
            <tr>
                <td><label for="fecha_pago">Fecha de Pago:</label></td>
                <td><input type="date" id="fecha_pago" name="fecha_pago" value="<?php echo $fecha_actual; ?>" required></td>
            </tr>
            <tr>
                <td><label for="cantidad_pagada">Cantidad Pagada:</label></td>
                <td><input type="number" id="cantidad_pagada" name="cantidad_pagada" required></td>
            </tr>
            <!-- Agregando el campo fecha_fin oculto -->
            <input type="hidden" name="fecha_fin" value="<?php echo $fecha_fin; ?>">
            <tr>
                <td><label for="forma_pago">Forma de Pago:</label></td>
                <td>
                    <select id="forma_pago" name="forma_pago" required>
                        <option value="Efectivo">Efectivo</option>
                        <option value="Tarjeta">Tarjeta</option>
                        <option value="Transferencia">Transferencia</option>
                    </select>
                </td>
            </tr>
    </table>

    <input type="submit" value="Registrar Pago">
    </form>
</div>

</body>
</html>
