<?php
include("../conexion.php");

if ($_SERVER['REQUEST_METHOD'] && isset($_POST["registrar"])) {

    $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
    $apellidos = isset($_POST["apellidos"]) ? $_POST["apellidos"] : "";
    $contrasenya = isset($_POST["contrasenya"]) ? $_POST["contrasenya"] : "";
    $contrasenya_repetida = isset($_POST["contrasenya_repetida"]) ? $_POST["contrasenya_repetida"] : "";
    $alta = isset($_POST["alta"]) ? $_POST["alta"] : "";
    $pago = isset($_POST["pago"]) ? $_POST["pago"] : 'NULL';
    $nacimiento = isset($_POST["nacimiento"]) ? $_POST["nacimiento"] : "";
    $tipo = isset($_POST["tipo_usuario"]) ? $_POST["tipo_usuario"] : "user";
    $tarifa = isset($_POST["tarifa"]) ? $_POST["tarifa"] : "";

    $email = isset($_POST["email"]) ? $_POST["email"] : "";
}

if ($contrasenya != $contrasenya_repetida ) {

    header('Location:../nuevoUsuario.php?error= Las contraseñas no son iguales');
    exit();
}


if ($nombre == "" || $apellidos == "" || $contrasenya == "" || $email == "" || $alta == ""  || $nacimiento == "") {

    header('Location:../nuevoUsuario.php?error= Hay algún campo vacío');
    exit();
}

$consultaUsuario = "SELECT * FROM clientes WHERE email = '$email'";
$consulta = mysqli_query($conexion, $consultaUsuario);

if ($fila = mysqli_num_rows($consulta) > 0) {
    header('Location:../nuevoUsuario.php?error= Usuario encontrado');
    exit();
}

$contraseñaCifrada = password_hash($contrasenya, PASSWORD_DEFAULT);
$pass = mysqli_real_escape_string($conexion, $contraseñaCifrada);

// de esta manera a la hora de crear un usuario no tiene por que pagar en el momento


    $insertoUsuario = "INSERT INTO clientes(nombre, apellidos, contrasenya, email, fecha_alta, fecha_nacimiento, tipo_usuario, tarifa) 
                   VALUES ('$nombre', '$apellidos', '$pass', '$email', '$alta',  '$nacimiento', '$tipo','$tarifa')";

$resultadoInsercion = mysqli_query($conexion, $insertoUsuario);

$id_cliente = mysqli_insert_id($conexion);

// La consulta para insertar en la tabla pagos
$sql_pagos = "INSERT INTO pagos(id_cliente, fecha_pago) VALUES ('$id_cliente', '$pago')";

// Ejecutas la consulta para pagos
mysqli_query($conexion, $sql_pagos);

if ($resultadoInsercion === false) {
    die("Error al ejecutar la consulta: " . mysqli_error($conexion));
}


// Cerrar la conexión
mysqli_close($conexion);
header('Location: registro_exitoso.php');
exit();
?>
