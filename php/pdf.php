<?php

require('../fpdf.php');
include('./conexion.php');

class PDF extends FPDF
{

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    $this->Cell(0,10,'Page '.$this->PageNo().'',0,0,'C');
}

}

$conex = conectar();
$consulta = "SELECT * FROM empleado";
$resultado = mysqli_query($conex, $consulta);

// Creación del objeto de la clase heredada
$pdf = new PDF('L','mm','A4');
$pdf->AddPage();

    $pdf->SetFont('Arial','B',15);
    $pdf->Cell(80);
    $pdf->Cell(100,10,utf8_decode('Información General'),0,0,'C');
    $pdf->Ln(20);


$pdf->SetFont('Arial','B',11);
    $pdf->Cell(30,10,'Id_Empleado',1,0,'C',0);
    $pdf->Cell(50,10,'Nombre',1,0,'C',0);
    $pdf->Cell(25,10,'Cedula',1,0,'C',0);
    $pdf->Cell(50,10,'Centro de costo',1,0,'C',0);
    $pdf->Cell(50,10,'Cargo',1,0,'C',0);
    $pdf->Cell(50,10,'Sueldo',1,0,'C',0);
    $pdf->Cell(20,10,'Dias',1,1,'C',0); 

    $pdf->SetFont('Arial','',11);
while($colum = mysqli_fetch_array($resultado)){

    $pdf->Cell(30,10,$colum['IdEmpleado'],1,0,'C',0);
    $pdf->Cell(50,10,$colum['Nombre'],1,0,'C',0);
    $pdf->Cell(25,10,$colum['Cedula'],1,0,'C',0);
    $pdf->Cell(50,10,utf8_decode($colum['Centro de costo']),1,0,'C',0);
    $pdf->Cell(50,10,$colum['Cargo'],1,0,'C',0);
    $pdf->Cell(50,10,$colum['Sueldo'],1,0,'C',0);
    $pdf->Cell(20,10,$colum['Dias'],1,1,'C',0); 
}
$pdf->AddPage();
$pdf->Output();
?>
