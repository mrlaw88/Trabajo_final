<?php

session_start();

if(isset($_SESSION["nombre"]) && isset($_SESSION["tipo_usuario"]))
{
  $nombre= $_SESSION["nombre"];
  $tipo_usuario= $_SESSION["tipo_usuario"];
  $email= $_SESSION["email"];
  
}else{

header("Location:http://20.19.37.89//vista/login.php");
}

?>