<?php
include "sesion.php";
include "saludo.php";
include "conexion.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro de usuarios</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <style>
        body {
            padding: 20px;
            background-color: #f8f9fa;
        }

        .contenedor {
            max-width: 700px;
            margin-top: 100px;
        }

        h1 {
            margin-bottom: 20px;
            color: #333;
        }


        .table th,
        .table td {
            vertical-align: middle;
            text-align: center;
        }

        .table-bordered th,
        .table-bordered td {
            border-width: 2px;
            /* Aquí se aumenta el grosor de las líneas */
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
    <div class="container contenedor">
        <h1 class="text-center">Registro de usuarios</h1>
        <?php
        if (isset($_GET["error"])) {
            $error = $_GET["error"];
            echo "<p style='color: red;'>$error</p>";
        }
        ?>
        <form action="./funciones/insertarUsuario.php" method="post">
            <table class="table table-bordered">
                <tr>
                    <td>Nombre: </td>
                    <td><input type="text" name="nombre" class="form-control" required></td>
                </tr>
                <tr>
                    <td>Apellidos:</td>
                    <td><input type="text" name="apellidos" class="form-control" required></td>
                </tr>
                <tr>
                    <td>Contraseña:</td>
                    <td><input type="password" name="contrasenya" class="form-control" required></td>
                </tr>
                <tr>
                    <td>Repita Contraseña:</td>
                    <td><input type="password" name="contrasenya_repetida" class="form-control" required></td>
                </tr>
                <tr>
                    <td>Fecha Alta:</td>
                    <td><input type="date" name="alta" id="alta" value="<?php echo date('Y-m-d'); ?>" class="form-control" required></td>
                </tr>
                <tr>
                    <td>Fecha Pago:</td>
                    <td><input type="date" name="pago" id="pago" class="form-control"></td>
                </tr>
                <tr>
                    <td>Fecha nacimiento:</td>
                    <td><input type="date" name="nacimiento" id="nacimiento" class="form-control" required></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="email" name="email" class="form-control" required></td>
                </tr>
                <tr>
                    <td>Tipo de usuario:</td>
                    <td>
                        <select name="tipo_usuario" class="form-control" required>
                            <option value="usuario">Usuario</option>
                            <option value="admin">Admin</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Tipo de usuario:</td>
                    <td>
                        <select name="tarifa" class="form-control" required>
                            <option value="2">2 clases/semanales</option>
                            <option value="3">3 clases/semanales</option>
                            <option value="4">4 clases/semanales</option>
                            <option value="5">Ilimitado</option>
                        </select>
                    </td>
                </tr>
            </table>
            <div class="text-center">
                <input type="submit" name="registrar" value="Registrar" class="btn btn-primary">
            </div>
        </form>
    </div>
</body>

</html>