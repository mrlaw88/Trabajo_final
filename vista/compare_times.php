<?php
header('Content-Type: application/json');

// Obtener la hora actual
$currentDateTime = new DateTime();

// Obtener la hora desde los parámetros GET
$timeString = $_GET['hora'] ?? '';

// Verificar si el string está vacío
if (empty($timeString)) {
    echo json_encode(['error' => 'No time provided']);
    exit;
}

// Convertir el string a un objeto DateTime
$inputTime = DateTime::createFromFormat('H:i', $timeString);

// Verificar si la conversión fue exitosa
if (!$inputTime) {
    echo json_encode(['error' => 'Invalid time format']);
    exit;
}

// Calcular la diferencia
$interval = $currentDateTime->diff($inputTime);
$hoursDifference = $interval->h + ($interval->days * 24);

// Verificar si la diferencia es menor a 1 hora
if ($hoursDifference < 1) {
    echo json_encode(['result' => 'NO PUEDES']);
} else {
    echo json_encode(['result' => 'OK']);
}
?>
