<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>

    <nav class=" navbar navbar-expand-md navbar-dark bg-dark fixed-top">    
        <a class="navbar-brand" href ="../index.php">Registar</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="#">Informacion General</a></li>
            </ul>
        </div>
    </nav>

</body>

</html>

<?php
//validamos datos del servidor
$user = "root";
$pass = "";
$host = "localhost";

echo "<br>";
echo "<br>";
echo "<br>";
//conetamos al base datos
$connection = mysqli_connect($host, $user, $pass);
    $datab = "Nomina";
    //indicamos selecionar ala base datos
    $db = mysqli_select_db($connection,$datab);

    $consulta = "SELECT * FROM empleado";



$result = mysqli_query($connection,$consulta);
if(!$result) 
{
    echo "No se ha podido realizar la consulta";
}

echo "<table align='center'>";
echo "<tr>";
echo "<th><h1>id</th></h1>";
echo "<th><h1>Nombre</th></h1>";
echo "<th><h1>Cedula</th></h1>";
echo "<th><h1>Centro de Costo</th></h1>";
echo "<th><h1>Cargo</th></h1>";
echo "<th><h1>Sueldo</th></h1>";
echo "<th><h1>Días</th></h1>";
echo "</tr>";

while ($colum = mysqli_fetch_array($result))
 {
    echo "<tr>";
    echo "<td><h2>" . $colum['IdEmpleado']. "</td></h2>";
    echo "<td><h2>" . $colum['Nombre']. "</td></h2>";
    echo "<td><h2>" . $colum['Cedula'] . "</td></h2>";
    echo "<td><h2>" . $colum['Centro de costo'] . "</td></h2>";
    echo "<td><h2>" . $colum['Cargo']. "</td></h2>";
    echo "<td><h2>" . $colum['Sueldo'] . "</td></h2>";
    echo "<td><h2>" . $colum['Dias'] . "</td></h2>";
    echo "</tr>";
}
echo "</table>";

mysqli_close( $connection );

?>
