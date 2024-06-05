<?php
include "vista/sesion.php";
include "vista/saludo.php";
include "modelo/conexion.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Sistema de Gimnasios</title>
</head>

<body>
    <h1>Pagina principal</h1>

    <form action="index.php" method="post">
        <label for="opcion">Selecciona una opción:</label>
        <select name="opcion" id="opcion">
            
            <option value="ver">Ver Horario</option>
            <option value="pagos">Consulta de pagos</option>
            <option value="perfilUsuario">Perfil</option>
            <option value="tienda">Tienda</option>
        <!-- aqui son las opciones solo para administradores(coach) -->
        <?php
        if($tipo_usuario == "admin"){
        ?>
            <option value="clientes">Ver clientes</option>
            <option value="nuevoUsuario">Crear nuevo usuario</option>
        <?php
        }
        ?>
        </select>
        <input type="submit" value="Ir">
    </form>

    <?php


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $opcion = $_POST["opcion"];

        if ($opcion == "clientes") {
            header("Location:mostrar_clientes.php");
            exit();
        } elseif ($opcion == "ver") {
            header("Location:horario.php");
            exit();
        } elseif ($opcion == "pagos") {
            header("Location:pagos.php");
            exit();
        } elseif ($opcion == "tienda") {
            header("Location:tienda.php");
            exit();
        } elseif ($opcion == "perfilUsuario") {
            header("Location:perfilUsuario.php");
            exit();
        } elseif ($opcion == "nuevoUsuario") {
            header("Location:nuevoUsuario.php");
            exit();
        } 
    }


    ?>
</body>

</html>