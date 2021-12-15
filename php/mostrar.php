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
echo "<thead>";

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

mysqli_close( $conex );

?>

