<?php

include "conexion.php";


if (isset($_POST["email"]) && isset($_POST["password"])) 
{
    $email = $_POST["email"];
    $contrasenya = $_POST["password"];

    $consulta = "SELECT * FROM clientes WHERE email = '$email'";
    $resultado = mysqli_query($conexion, $consulta);

    $email1 = mysqli_real_escape_string($conexion,$email);
    $contrasenya1 = mysqli_real_escape_string($conexion,$contrasenya);

    // Verificar si hubo algún error al ejecutar la consulta
    if ($resultado === false) {
        die("Error al ejecutar la consulta: " . mysqli_error($conexion));
    }

    // Obtener el hash de la contrasenya almacenado en la base de datos
    if ($row = mysqli_fetch_assoc($resultado)) 
    {
        $contrasenyaCifrada = $row['contrasenya'];

        if (password_verify($contrasenya1, $contrasenyaCifrada)) 
        {
                
            // La contrasenya es correcta
            session_start();
            $_SESSION['nombre']=$row['nombre'];
            $_SESSION['tipo_usuario']=$row['tipo_usuario'];
            $_SESSION['email']=$row['email'];
            header('Location: ../index.php');
            exit();
        } 
        else 
        {
            echo "Acceso denegado, la contrasenya es incorrecta";
            // La contrasenya es incorrecta
           ?> <br>
<P>[ <A HREF='../index.php'>Volver al Index</A> ]</P>
<?php
        }
    } 
    else 
    {
        echo "email no encontrado";
        // El email no existe en la base de datos
        ?> <br>
        <P>[ <A HREF='../index.php'>Volver al Index</A> ]</P>
        <?php
    }

    // Cerrar la conexión
    mysqli_close($conexion);
} 
else 
{
    echo "Por favor, proporcione un email y una contrasenya.";
    ?> <br>
    <P>[ <A HREF='../index.php'>Volver al Index</A> ]</P>
    <?php
}
?>
