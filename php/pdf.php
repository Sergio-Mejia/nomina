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
$pdf->AddPage();//Información

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

$pdf->AddPage();//Deducciones 

$pdf->SetFont('Arial','B',15);
$pdf->Cell(80);
$pdf->Cell(100,10,utf8_decode('Devengados'),0,0,'C');
$pdf->Ln(20);

$pdf->SetFont('Arial','B',9);
$pdf->Cell(28,10,'Cedula',1,0,'C',0);
$pdf->Cell(15,10,'Dias',1,0,'C',0);
$pdf->Cell(25,10,'salario_dias',1,0,'C',0);
$pdf->Cell(35,10,'vacacionesD',1,0,'C',0);
$pdf->Cell(35,10,'auxilio transporte',1,0,'C',0);
$pdf->Cell(20,10,'Eps',1,0,'C',0);
$pdf->Cell(20,10,'arl',1,0,'C',0); 
$pdf->Cell(20,10,'Rnocturno',1,0,'C',0); 
$pdf->Cell(20,10,'Dominicales',1,0,'C',0); 
$pdf->Cell(33,10,'auxilio alimentacion',1,0,'C',0); 
$pdf->Cell(26,10,'total devengado',1,1,'C',0);



$pdf->SetFont('Arial','',11);

$resultado = mysqli_query($conex, $consulta);
while($colum = mysqli_fetch_array($resultado)){

    $pdf->Cell(28,10,$colum['Cedula'],1,0,'C',0);
    $pdf->Cell(15,10,$colum['Dias'],1,0,'C',0);
    $pdf->Cell(25,10,$colum['salario_dias'],1,0,'C',0);
    $pdf->Cell(35,10,$colum['vacacionesD'],1,0,'C',0);
    $pdf->Cell(35,10,$colum['auxilio_transporte'],1,0,'C',0);
    $pdf->Cell(20,10,$colum['Eps'],1,0,'C',0);
    $pdf->Cell(20,10,$colum['arl'],1,0,'C',0); 
    $pdf->Cell(20,10,$colum['Rnocturno'],1,0,'C',0); 
    $pdf->Cell(20,10,$colum['Dominicales'],1,0,'C',0); 
    $pdf->Cell(33,10,$colum['auxilio_alimentacion'],1,0,'C',0); 
    $pdf->Cell(26,10,$colum['total_devengado'],1,1,'C',0); 

}
//------------------------------------------------//deducciones//--------------------------------------//
$pdf->AddPage();

$pdf->SetFont('Arial','B',15);
$pdf->Cell(80);
$pdf->Cell(100,10,utf8_decode('Deducciones'),0,0,'C');
$pdf->Ln(20);

$pdf->SetFont('Arial','B',9);

$pdf->Cell(24,10,'Cedula',1,0,'C',0);
$pdf->Cell(15,10,'salud',1,0,'C',0);
$pdf->Cell(25,10,'pension',1,0,'C',0);
$pdf->Cell(15,10,'FSP',1,0,'C',0);
$pdf->Cell(20,10,'Monto',1,0,'C',0);
$pdf->Cell(24,10,'fecha',1,0,'C',0);
$pdf->Cell(25,10,'Cuotas',1,0,'C',0); 
$pdf->Cell(25,10,'cuotas pag',1,0,'C',0); 
$pdf->Cell(25,10,'cuotas desc',1,0,'C',0); 
$pdf->Cell(25,10,'saldoP',1,0,'C',0); 
$pdf->Cell(26,10,'total',1,0,'C',0);  
$pdf->Cell(33,10,'total nomina',1,1,'C',0); 

$pdf->SetFont('Arial','',11);

$resultado = mysqli_query($conex, $consulta);
while($colum = mysqli_fetch_array($resultado)){

    $pdf->Cell(24,10,$colum['Cedula'],1,0,'C',0);
    $pdf->Cell(15,10,$colum['salud'],1,0,'C',0);
    $pdf->Cell(25,10,$colum['pension'],1,0,'C',0);
    $pdf->Cell(15,10,$colum['fondo_solidaridad_pensional'] ,1,0,'C',0);
    $pdf->Cell(20,10,$colum['Monto'],1,0,'C',0);
    $pdf->Cell(24,10,$colum['fecha'] ,1,0,'C',0);
    $pdf->Cell(25,10,$colum['Cuotas'],1,0,'C',0); 
    $pdf->Cell(25,10,$colum['cuotas_pagadas'],1,0,'C',0); 
    $pdf->Cell(25,10,$colum['cuotas_descuento'],1,0,'C',0); 
    $pdf->Cell(25,10,$colum['saldoP'] ,1,0,'C',0); 
    $pdf->Cell(26,10,$colum['total_deduccions'] ,1,0,'C',0);  
    $pdf->Cell(33,10,$colum['total_nomina'],1,1,'C',0);  
    
}

//------------------------------------------------//Prestaciones//--------------------------------------//
$pdf->AddPage();

$pdf->SetFont('Arial','B',15);
$pdf->Cell(80);
$pdf->Cell(100,10,utf8_decode('Prestaciones Y Totales'),0,0,'C');
$pdf->Ln(20);

$pdf->SetFont('Arial','B',9);

$pdf->Cell(140,10,'Prestaciones',0,0,'C',0);

$pdf->Cell(30);

$pdf->Cell(70,10,'Totales',0,1,'C',0);



$pdf->Cell(24,10,'Cedula',1,0,'C',0);
$pdf->Cell(15,10,'prima',1,0,'C',0);
$pdf->Cell(25,10,'cesantias',1,0,'C',0);
$pdf->Cell(33,10,'intereses cesantias' ,1,0,'C',0);
$pdf->Cell(20,10,'vacaciones',1,0,'C',0);
$pdf->Cell(24,10,'Totales',1,0,'C',0);

$pdf->Cell(30);


$pdf->Cell(25,10,'Costo diario',1,0,'C',0); 
$pdf->Cell(25,10,'costo mensual',1,0,'C',0); 
$pdf->Cell(25,10,'Costo Anual',1,1,'C',0); 

$pdf->SetFont('Arial','',11);

$resultado = mysqli_query($conex, $consulta);
while($colum = mysqli_fetch_array($resultado)){

    $pdf->Cell(24,10,$colum['Cedula'],1,0,'C',0);
    $pdf->Cell(15,10,$colum['prima'],1,0,'C',0);
    $pdf->Cell(25,10,$colum['cesantias'],1,0,'C',0);
    $pdf->Cell(33,10,$colum['intereses_cesantias'] ,1,0,'C',0);
    $pdf->Cell(20,10,$colum['vacaciones'],1,0,'C',0);
    $pdf->Cell(24,10,$colum['Totales'] ,1,0,'C',0);

    $pdf->Cell(30);

    $pdf->Cell(25,10,$colum['Costo_diario'],1,0,'C',0); 
    $pdf->Cell(25,10,$colum['costo_mensual'],1,0,'C',0); 
    $pdf->Cell(25,10,$colum['Costo_Anual'],1,1,'C',0); 
}

$pdf->Output();
