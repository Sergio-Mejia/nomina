<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/style.css">
    <title>Formulario Nomina</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body>
    <nav class=" navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">Registar</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="php/mostrar.php">Datos</a></li>

            </ul>
        </div>
    </nav>

    <a href="#"></a>
    <h1>Formulario de registro</h1>
    <form action="" name="" method="POST">
        <table border="0" align="center">
            <tr>
                <td>
                    Nombre Completo:
                </td>
                <td>
                    <label for="name"></label>
                    <input type="text" name="nombre" id="name" />
                </td>
            </tr>
            <tr>
                <td>
                    Cedula:
                </td>
                <td>
                    <label for="id1"></label>
                    <input type="text" name="cedula" id="id1" />
                </td>
            </tr>
            <tr>
                <td>
                    Centro de costo:
                </td>
                <td>
                    <label for="CentroCosto"></label>
                    <input type="text" name="Ccosto" id="CentroCosto" />
                </td>
            </tr>
            <tr>
                <td>
                    Cargo:
                </td>
                <td>
                    <label for="Cargo"></label>
                    <input type="text" name="Cargo" id="cargo" />
                </td>
            </tr>
            <tr>
                <td>
                    Sueldo:
                </td>
                <td>
                    <label for="sueldo"></label>
                    <input type="number" name="Saldo" id="sueldo" />
                </td>
            </tr>
            <tr>
                <td>
                    Dias:
                </td>
                <td>
                    <label for="dias"></label>
                    <input type="number" name="daysa" id="dias" />
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td align="center">
                    <input type="submit" name="enviar" id="enviar" value="Registrarse" />
                </td>
                <td align="center">
                    <input type="reset" name="borrar" id="borrar" value="Restablecer" />
                </td>


            </tr>
        </table>
    </form>



</body>

</html>

<?php
include('php/funciones.php');
include('php/conexion.php');
if (isset($_POST['enviar'])) {
   
    $conex = conectar();

    //hacemos llamado al input de formuario
    $nombre = $_POST["nombre"];
    $cedula = $_POST["cedula"];
    $ccosto = $_POST["Ccosto"];
    $cargo = $_POST["Cargo"];
    $saldo = $_POST["Saldo"];
    $days = $_POST["daysa"];


    $devengados = total_devengados($saldo, vacaciones($saldo, $days), auxilio_transporte($saldo), auxilio_alimentacion($saldo, $days));
    $deducciones = total_deducciones(salud_pension($saldo), fondo_solidaridad($saldo));
    $prima_ces = prima_cesantias($saldo, auxilio_transporte($saldo));
    $cMensual = costoMensual($devengados, total_pres($prima_ces, intereses($prima_ces,$days), vacaciones2($saldo)));

    //insertamos datos de registro al mysql xampp, indicando nombre de la tabla y sus atributos
    $instruccion_SQL = "INSERT INTO `empleado`(`Nombre`, `Cedula`, `Centro de costo`, `Cargo`, `Sueldo`, `Dias`, `salario_dias`,
     `auxilio_transporte`,`auxilio_alimentacion`,`total_devengado`,`salud`,`pension`,`fondo_solidaridad_pensional`,`total_deduccions`,
     `total_nomina`,`prima`,`cesantias`,`intereses_cesantias`,`vacaciones`,`Totales`,`Costo_diario`,`costo_mensual`,`Costo_Anual`)
                        VALUES ('$nombre','$cedula','$ccosto','$cargo','$saldo','$days'," . salario_dias($saldo, $days) . ", " . auxilio_transporte($saldo) . "," . auxilio_alimentacion($saldo, $days) . ",
                        '$devengados'," . salud_pension($saldo) . ", " . salud_pension($saldo) . ", " . fondo_solidaridad($saldo) . ",
                        '$deducciones', " . total_nomina($devengados, $deducciones) . ", '$prima_ces', '$prima_ces', ".intereses($prima_ces,$days).",
                        ".vacaciones2($saldo).", ".total_pres($prima_ces, intereses($prima_ces,$days), vacaciones2($saldo)).",
                        ".costoDiario($cMensual).", '$cMensual', ".costoAnual($cMensual).")";

    $resultado = mysqli_query($conex, $instruccion_SQL) or die ("Error en la consulta $sql".mysqli_error($conex));
    if ($resultado == 1) {
        echo "<script>alert('El usuario se registró correctamente')</script>";
    }
}

//echo "resultado: ". salario_dias($saldo,$days);

?>