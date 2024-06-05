<?php
include "sesion.php";
include "saludo.php";
include "conexion.php";

$sql = "SELECT id, tarifa FROM clientes WHERE email = '$email'";
$resultado = mysqli_query($conexion, $sql);

// Verificar si la consulta fue exitosa y obtener el id_cliente y tarifa
$id_cliente = null;
$tarifa = null;
$tipo_tarifa = null;
if ($resultado && mysqli_num_rows($resultado) > 0) {
    $fila = mysqli_fetch_assoc($resultado);
    $id_cliente = $fila['id'];
    $tarifa = $fila['tarifa'];
    
    
    // Obtener el tipo de tarifa
    switch ($tarifa) {
        case 2:
            $tipo_tarifa = "Tarifa 2 - Máximo 2 clases";
            break;
        case 3:
            $tipo_tarifa = "Tarifa 3 - Máximo 3 clases";
            break;
        case 4:
            $tipo_tarifa = "Tarifa 4 - Máximo 4 clases";
            break;
        case 5:
            $tipo_tarifa = "Tarifa 5 - Clases ilimitadas";
            break;
        default:
            $tipo_tarifa = "Tarifa desconocida";
            break;
    }
}

// Obtener el número de inscripciones activas (id_reservado = 1) para el cliente
$inscripciones_activas = 0;
if ($id_cliente) {
    $sql_inscripciones = "SELECT COUNT(*) as inscripciones FROM reservas WHERE id_cliente = $id_cliente AND id_reservado = 1";
    $resultado_inscripciones = mysqli_query($conexion, $sql_inscripciones);
    if ($resultado_inscripciones && mysqli_num_rows($resultado_inscripciones) > 0) {
        $fila_inscripciones = mysqli_fetch_assoc($resultado_inscripciones);
        $inscripciones_activas = $fila_inscripciones['inscripciones'];
    }
}

$horario_inscrito = array(); // Array para almacenar el estado de inscripción
if ($id_cliente) {
    $sql_horario = "SELECT hora, dia, id_reservado FROM reservas WHERE id_cliente = $id_cliente";
    $resultado_horario = mysqli_query($conexion, $sql_horario);

    if ($resultado_horario && mysqli_num_rows($resultado_horario) > 0) {
        while ($fila_horario = mysqli_fetch_assoc($resultado_horario)) {
            $hora = $fila_horario['hora'];
            $dia = $fila_horario['dia'];
            $id_reservado = $fila_horario['id_reservado'];
            $horario_inscrito[$dia][$hora][$id_reservado] = true; // Marcar como inscrito
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horario Funcional</title>
    <style>
        .table-container {
            display: flex;
            justify-content: center;
            margin: 20px;
        }

        table {
            border-collapse: collapse;
            width: 80%; /* Ajusta el ancho según tus necesidades */
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #20c67a;
        }

        .funcional {
            background-color: #a0fb0e;
            color: black;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .funcional:hover {
            background-color: #45a049; /* Cambia a verde más oscuro al pasar el cursor */
        }
    </style>
</head>
<body>

<h2 style="text-align: center;">Horario Funcional</h2>
<p style="text-align: center;">Tu tarifa: <?php echo $tipo_tarifa; ?></p>

<div class="table-container">
    <table>
        <tr>
            <th>Hora</th>
            <th>Lunes</th>
            <th>Martes</th>
            <th>Miércoles</th>
            <th>Jueves</th>
            <th>Viernes</th>
            <th>Sábado</th>
            <th>Domingo</th>
        </tr>
        <?php
        // Definir las horas
        $horas = array(
            "7:30", "9:00", "10:00", "11:00", "Cerrado", 
            "17:00", "18:00", "19:00", "20:00", "21:00"
        );

        foreach ($horas as $hora) {
            echo "<tr>";
            echo "<td>$hora</td>";
            foreach (array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo") as $dia) {
                echo "<td";
                if ($dia == "Sábado" || $dia == "Domingo" || $hora == "Cerrado") {
                    echo " style='background-color: #ffffff;'>Cerrado</td>";
                } else {
                    echo " class='funcional'";
                    if (isset($horario_inscrito[$dia][$hora][1])) {
                        echo " style='background-color: #ffa43a;'";
                        echo " onclick='changeColor(this)'>Inscrito</td>";
                    } else {
                        echo " onclick='changeColor(this)'>Funcional</td>";
                    }
                }
            }
            echo "</tr>";
        }
        ?>
    </table>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    var tarifa = <?php echo json_encode($tarifa); ?>;
    var inscripciones_activas = <?php echo json_encode($inscripciones_activas); ?>;

    function changeColor(element) {
        var isClicked = element.classList.contains("clicked");
        var now = new Date();
        var currentDay = now.getDay(); // Obtener el día de la semana actual (0 para Domingo, 1 para Lunes, ..., 6 para Sábado)
        var currentHour = now.getHours();
        var currentMinute = now.getMinutes();
        var hora = element.parentNode.cells[0].innerText;
        var dia = element.parentNode.parentNode.rows[0].cells[element.cellIndex].innerText;
        var horaReserva = parseInt(hora.split(":")[0]);
        var minutoReserva = parseInt(hora.split(":")[1]);

        // Objeto para mapear los días de la semana con sus números correspondientes
        var diasSemana = {
            "Domingo": 0,
            "Lunes": 1,
            "Martes": 2,
            "Miércoles": 3,
            "Jueves": 4,
            "Viernes": 5,
            "Sábado": 6
        };

        // Calcula la diferencia de tiempo en minutos
        var differenceInMinutes = (horaReserva - currentHour) * 60 + (minutoReserva - currentMinute);

        // Si el día de la reserva es anterior al día actual, no permitir cambios
        if (diasSemana[dia] < currentDay) {
            alert("No puedes cambiar una reserva de días anteriores.");
            return;
        }

        // Si el día de la reserva es el día actual pero la hora ya ha pasado, no permitir cambios
        if (diasSemana[dia] === currentDay && differenceInMinutes < 0) {
            alert("No puedes cambiar una reserva de horas anteriores en el día actual.");
            return;
        }

        // Verifica si falta más de 59 minutos y se está en un día posterior al actual, permite anular la reserva
        if (differenceInMinutes >= 59 || diasSemana[dia] > currentDay) {
            // Condición adicional para la tarifa
            if ((tarifa == 2 && inscripciones_activas >= 2 && element.innerText !== 'Inscrito') ||
                (tarifa == 3 && inscripciones_activas >= 3 && element.innerText !== 'Inscrito') ||
                (tarifa == 4 && inscripciones_activas >= 4 && element.innerText !== 'Inscrito')) {
                alert("Has alcanzado el límite de clases permitidas para tu tarifa.");
                return;
            }

            // Cambia el estado de la reserva a "Funcional" y permite anular la reserva
            if (element.innerText === 'Inscrito') {
                if (isClicked) {
                    element.classList.remove("clicked");
                }
                element.innerText = 'Funcional';
                element.style.backgroundColor = '#a0fb0e';
                inscripciones_activas--; // Reducir el contador
            } else {
                if (!isClicked) {
                    element.classList.add("clicked");
                }
                element.innerText = 'Inscrito';
                element.style.backgroundColor = '#ffa43a';
                inscripciones_activas++; // Aumentar el contador
            }

            // Envía los datos al backend usando AJAX
            var datos = {
                hora: hora,
                dia: dia,
                id_cliente: <?php echo json_encode($id_cliente); ?>
            };

            $.ajax({
                url: 'backend.php',
                method: 'POST',
                data: datos,
                success: function(response) {
                    console.log('Datos enviados al servidor');
                },
                error: function(xhr, status, error) {
                    console.error('Error al enviar los datos al servidor:', error);
                }
            });
        } else {
            // Si no se cumple la condición para anular la reserva, mostrar un mensaje de alerta
            alert("No puedes anular una reserva si faltan menos de 1 hora.");
        }
    }
</script>

</body>
</html>
