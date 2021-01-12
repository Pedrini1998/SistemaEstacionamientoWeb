<?php
    if (isset($_POST['btnCalcular'])) {
        echo("hola");
        ob_start();
        require('fpdf.php');

        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(40,10,'¡Gracias por Venir!');
        $pdf->Output();
        ob_end_flush(); 
    }
?>