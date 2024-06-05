<?php
require('vendor/fpdf/fpdf.php'); // Ajusta el path según donde tengas FPDF

include "sesion.php";
include "conexion.php";
include "./funciones/fecha.php";


if (isset($_POST['id_pago'])) {
    $id_pago = $_POST['id_pago'];

    // Consulta para obtener la información del pago
    $instruccion_pago = "SELECT clientes.*, pagos.*
                         FROM clientes
                         JOIN pagos ON clientes.id = pagos.id_cliente
                         WHERE pagos.id_pago = '$id_pago'";
    $consulta_pago = mysqli_query($conexion, $instruccion_pago);
    $pago = mysqli_fetch_assoc($consulta_pago);

    if ($pago) {
        // Crear un nuevo PDF utilizando FPDF
        $pdf = new FPDF();
        $pdf->AddPage();

        // Añadir el logo de la empresa
        $pdf->Image('../img/gimlogo.png', 10, 10, 30); // Ajusta la ruta y el tamaño según sea necesario

        // Información de la empresa
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'EstudioFit', 0, 1, 'C');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, 'Alejandro Law Roca', 0, 1, 'C');
        $pdf->Cell(0, 10, 'Telefono: 622076884', 0, 1, 'C');
        $pdf->Cell(0, 10, 'Calle San Pablo, Torrevieja (Alicante)', 0, 1, 'C');
        $pdf->Cell(0, 10, 'DNI: 48628979X', 0, 1, 'C');
        $pdf->Cell(0, 10, 'Email: law.roca.alejandro@gmail.com', 0, 1, 'C');
        $pdf->Ln(10);

        // Título de la factura
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'Factura', 0, 1, 'C');
        $pdf->Ln(10);

        // Información del cliente
        $pdf->Cell(0, 10, 'ID Pago: ' . $pago['id_pago'], 0, 1);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, 'Nombre: ' . $pago['nombre'], 0, 1);
        $pdf->Cell(0, 10, 'Apellidos: ' . $pago['apellidos'], 0, 1);
        $pdf->Cell(0, 10, 'Email: ' . $pago['email'], 0, 1);
        $pdf->Ln(10);

        // Información del pago
    
        $pdf->Cell(0, 10, 'Fecha de Pago: ' . date2string($pago['fecha_pago']), 0, 1);
        $pdf->Cell(0, 10, 'Fecha Fin: ' . date2string($pago['fecha_fin']), 0, 1);
        $pdf->Cell(0, 10, 'Cantidad: ' . $pago['cantidad_pagada'], 0, 1);
        $pdf->Cell(0, 10, 'Forma de Pago: ' . $pago['forma_pago'], 0, 1);

        // Salida del PDF
        $pdf->Output('D', 'Factura_'.$pago['id_pago'].'.pdf');
    } else {
        echo "No se encontró el pago.";
    }
} else {
    echo "ID de pago no proporcionado.";
}

// Cerrar conexión
mysqli_close($conexion);
?>
