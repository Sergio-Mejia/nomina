<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Datos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <nav class=" navbar navbar-expand-md navbar-dark bg-dark fixed-top">    
        <a class="navbar-brand" href ="../index.php">Registar</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="#">Datos</a></li>
                <li class="nav-item"><a class="nav-link" href="./prestamos.php">Préstamos</a></li>
            </ul>
        </div>
    </nav>
    <br><br><br>
</body>

</html>

<?php
include('./conexion.php');

$conex = conectar();

$consulta = "SELECT * FROM empleado";


$result = mysqli_query($conex,$consulta);
if(!$result) 
{
    echo "No se ha podido realizar la consulta";
}

echo "<div class='container'>";
echo "<h2>Información General</h2>";
echo "<table align='center' class='table table-light table-striped table-hover'>";
echo "<thead>";
echo "<tr>";
echo "<td><h4>id</td></h4>";
echo "<td><h4>Nombre</td></h4>";
echo "<td><h4>Cedula</td></h4>";
echo "<td><h4>Centro de Costo</td></h4>";
echo "<td><h4>Cargo</td></h4>";
echo "<td><h4>Sueldo</td></h4>";
echo "<td><h4>Días</td></h4>";
echo "</tr>";
echo "</thead>";

while ($colum = mysqli_fetch_array($result))
 {
    echo "<tr>";
    echo "<td>" . $colum['IdEmpleado']. "</td>";
    echo "<td>" . $colum['Nombre']. "</td>";
    echo "<td>" . $colum['Cedula'] . "</td>";
    echo "<td>" . $colum['Centro de costo'] . "</td>";
    echo "<td>" . $colum['Cargo']. "</td>";
    echo "<td>" . $colum['Sueldo'] . "</td>";
    echo "<td>" . $colum['Dias'] . "</td>";
    echo "</tr>";
}
echo "</table>";
echo "</div>";

$consulta1 = "SELECT * FROM empleado";
$result1 = mysqli_query($conex,$consulta1);

echo "<div class='container'>";
echo "<h2>Devengados</h2>";
echo "<table align='center' class='table table-light table-striped table-hover'>";
echo "<thead>";
echo "<tr>";
echo "<td><h5>Cedula</td></h5>";
echo "<td><h5>Días Laborados</td></h5>";
echo "<td><h5>Salario Días Laborados</td></h5>";
echo "<td><h5>Vacaciones</td></h5>";
echo "<td><h5>Auxilio transporte</td></h5>";
echo "<td><h5>Incapacidad EPS</td></h5>";
echo "<td><h5>Incapacidad ARL</td></h5>";
echo "<td><h5>Recargo Nocturno</td></h5>";
echo "<td><h5>Horas Dominicales</td></h5>";
echo "<td><h5>Auxilio alimentación</td></h5>";
echo "<td><h5>Total Devengado</td></h5>";
echo "</tr>";
echo "</thead>";

while ($colum = mysqli_fetch_array($result1))
 {
    echo "<tr>";
    echo "<td>" . $colum['Cedula']. "</td>";
    echo "<td>" . $colum['Dias']. "</td>";
    echo "<td>" . $colum['salario_dias'] . "</td>";
    echo "<td>" . $colum['vacacionesD'] . "</td>";
    echo "<td>" . $colum['auxilio_transporte']. "</td>";
    echo "<td>" . $colum['Eps'] . "</td>";
    echo "<td>" . $colum['arl'] . "</td>";
    echo "<td>" . $colum['Rnocturno'] . "</td>";
    echo "<td>" . $colum['Dominicales'] . "</td>";
    echo "<td>" . $colum['auxilio_alimentacion'] . "</td>";
    echo "<td>" . $colum['total_devengado'] . "</td>";
    echo "</tr>";
}
echo "</table>";
echo "</div>";



$consulta2 = "SELECT * FROM empleado";
$result2 = mysqli_query($conex,$consulta2);

echo "<div class='container'>";
echo "<h2>Deducciones</h2>";
echo "<table align='center' class='table table-light table-striped table-hover'>";
echo "<thead>";
echo "<tr>";
echo "<td><h5>Cedula</td></h5>";
echo "<td><h5>Salud</td></h5>";
echo "<td><h5>Pension</td></h5>";
echo "<td><h5>Fondo solidaridad</td></h5>";
echo "<td><h5>Monto Desembolso</td></h5>";
echo "<td><h5>No Cuotas</td></h5>";
echo "<td><h5>Fecha Desembolso</td></h5>";
echo "<td><h5>No Cuota a pagar</td></h5>";
echo "<td><h5>Cuotas por descontar</td></h5>";
echo "<td><h5>Valor Cuota</td></h5>";
echo "<td><h5>Saldo Préstamo</td></h5>";
echo "<td><h5>Total deducciones</td></h5>";
echo "<td><h5>Total Nómina a pagar</td></h5>";
echo "</tr>";
echo "</thead>";

while ($colum = mysqli_fetch_array($result2))
 {
    echo "<tr>";
    echo "<td>" . $colum['Cedula']. "</td>";
    echo "<td>" . $colum['salud']. "</td>";
    echo "<td>" . $colum['pension'] . "</td>";
    echo "<td>" . $colum['fondo_solidaridad_pensional'] . "</td>";
    echo "<td>" . $colum['Monto']. "</td>";
    echo "<td>" . $colum['Cuotas'] . "</td>";
    echo "<td>" . $colum['fecha'] . "</td>";
    echo "<td>" . $colum['cuotas_pagadas'] . "</td>";
    echo "<td>" . $colum['cuotas_descuento'] . "</td>";
    echo "<td>" . $colum['valor_cuota'] . "</td>";
    echo "<td>" . $colum['saldoP'] . "</td>";
    echo "<td>" . $colum['total_deduccions'] . "</td>";
    echo "<td>" . $colum['total_nomina'] . "</td>";
    echo "</tr>";
}
echo "</table>";
echo "</div>";


$consulta3 = "SELECT * FROM empleado";
$result3 = mysqli_query($conex,$consulta3);

echo "<div class='container'>";
echo "<h2>Prestaciones Sociales</h2>";
echo "<table align='center' class='table table-light table-striped table-hover'>";
echo "<thead>";
echo "<tr>";
echo "<td><h5>Cedula</td></h5>";
echo "<td><h5>Prima</td></h5>";
echo "<td><h5>Cesantías</td></h5>";
echo "<td><h5>Interes Cesantías</td></h5>";
echo "<td><h5>Vacaciones</td></h5>";
echo "<td><h5>Totales</td></h5>";
echo "</tr>";
echo "</thead>";

while ($colum = mysqli_fetch_array($result3))
 {
    echo "<tr>";
    echo "<td>" . $colum['Cedula']. "</td>";
    echo "<td>" . $colum['prima']. "</td>";
    echo "<td>" . $colum['cesantias'] . "</td>";
    echo "<td>" . $colum['intereses_cesantias'] . "</td>";
    echo "<td>" . $colum['vacaciones']. "</td>";
    echo "<td>" . $colum['Totales'] . "</td>";
    echo "</tr>";
}
echo "</table>";
echo "</div>";


$consulta4 = "SELECT * FROM empleado";
$result4 = mysqli_query($conex,$consulta4);

echo "<div class='container'>";
echo "<h2>Totales de la Empresa</h2>";
echo "<table align='center' class='table table-light table-striped table-hover'>";
echo "<thead>";
echo "<tr>";
echo "<td><h5>Cedula</td></h5>";
echo "<td><h5>Total Diario</td></h5>";
echo "<td><h5>Total Mensual</td></h5>";
echo "<td><h5>Total Anual</td></h5>";
echo "</tr>";
echo "</thead>";

while ($colum = mysqli_fetch_array($result4))
 {
    echo "<tr>";
    echo "<td>" . $colum['Cedula']. "</td>";
    echo "<td>" . $colum['Costo_diario']. "</td>";
    echo "<td>" . $colum['costo_mensual']. "</td>";
    echo "<td>" . $colum['Costo_Anual'] . "</td>";
    echo "</tr>";
}
echo "</table>";
echo "</div>";

mysqli_close( $conex );

?>

