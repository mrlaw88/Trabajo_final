<?php
include "conexion.php";

// Verifica si la solicitud es de tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si se reciben los datos esperados
    if (isset($_POST["hora"]) && isset($_POST["dia"]) && isset($_POST["id_cliente"])) {
        // Conecta a la base de datos
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica la conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Escapa los valores para evitar inyección de SQL
        $hora = mysqli_real_escape_string($conn, $_POST["hora"]);
        $dia = mysqli_real_escape_string($conn, $_POST["dia"]);
        $id_cliente = mysqli_real_escape_string($conn, $_POST["id_cliente"]);

        // Verifica si ya existe una reserva para este cliente y horario
        // Comprobar si ya existe una reserva con los mismos datos
$sql_check_reservation = "SELECT * FROM reservas WHERE id_cliente = '$id_cliente' AND hora = '$hora' AND dia = '$dia'";
$result_check_reservation = $conn->query($sql_check_reservation);

// Comprobar si existe una reserva antigua (cancelada)
$sql_check_reserva_antigua = "SELECT * FROM reservas WHERE id_cliente = '$id_cliente' AND hora = '$hora' AND dia = '$dia' AND id_reservado = 2";
$result_check_reservation_antigua = $conn->query($sql_check_reserva_antigua);

if ($result_check_reservation->num_rows == 0) {
    // No existe una reserva, por lo tanto, creamos una nueva estableciendo id_reservado en 1
    $sql_insert_reservation = "INSERT INTO reservas (hora, dia, id_cliente, id_reservado) VALUES ('$hora', '$dia', '$id_cliente', 1)";
    if ($conn->query($sql_insert_reservation) === TRUE) {
        echo "Reserva realizada correctamente";
    } else {
        echo "Error al realizar la reserva: " . $conn->error;
    }
} else {
    // Si existe alguna reserva pero está en 2 (Cancelada) la cambiamos a 1 (Reservado)
    if ($result_check_reservation_antigua->num_rows > 0) {
        $sql_update_reservation = "UPDATE reservas SET id_reservado = 1 WHERE id_cliente = '$id_cliente' AND hora = '$hora' AND dia = '$dia'";
        if ($conn->query($sql_update_reservation) === TRUE) {
            echo "Reserva realizada correctamente";
        } else {
            echo "Error al actualizar la reserva: " . $conn->error;
        }
    } else {
        // Ya existe una reserva activa, por lo tanto, actualizamos el estado de id_reservado a 0 para cancelarla
        $sql_update_reservation = "UPDATE reservas SET id_reservado = 2 WHERE id_cliente = '$id_cliente' AND hora = '$hora' AND dia = '$dia'";
        if ($conn->query($sql_update_reservation) === TRUE) {
            echo "Reserva cancelada correctamente";
        } else {
            echo "Error al cancelar la reserva: " . $conn->error;
        }
    }
}


        // Cierra la conexión
        $conn->close();
    } else {
        // Si faltan datos esperados en la solicitud
        echo "Faltan datos en la solicitud";
    }
} else {
    // Si la solicitud no es de tipo POST
    echo "Acceso denegado";
}
