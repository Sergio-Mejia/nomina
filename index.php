<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Formulario Nomina</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div>
    <nav class=" navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">Registar</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="php/mostrar.php">Datos</a></li>
                <li class="nav-item"><a class="nav-link" href="php/prestamos.php">Préstamos</a></li>
            </ul>
        </div>
    </nav>
    </div>
<br><br><br>
    <a href="#"></a>
    
    <div class="container">
        <div class="cont">
            <h1>Formulario de registro</h1>
            <hr class="bg bg-light">
            <form action="" class="row g-3" method="post">
                <div class="col-md-12">
                    <label class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Cedula</label>
                    <input type="text" class="form-control" id="id1" name="cedula">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Centro de Costo</label>
                    <input type="text" name="Ccosto" id="CentroCosto" class="form-control" />
                </div>
                <div class="col-md-6">
                    <label class="form-label">Cargo</label>
                    <input type="text" name="Cargo" id="cargo" class="form-control" />
                </div>
                <div class="col-md-6">
                    <label class="form-label">Sueldo</label>
                    <input type="number" name="Saldo" id="sueldo" class="form-control" />
                </div>
                <div class="col-md-6">
                    <label class="form-label">Días Trabajados</label>
                    <input type="number" name="daysa" id="dias" class="form-control" />
                </div>
                <div class="col-md-6">
                    <label class="form-label">Días de Vacaciones</label>
                    <td><input type="number" name="vaca" id="vaca" class="form-control"></td>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Dominicales</label>
                    <td><input type="number" name="domi" id="domi" class="form-control"></td>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Días de Incapacidad EPS</label>
                    <input type="number" name="eps" id="eps" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Días de Incapacidad ARL</label>
                    <input type="number" name="arl" id="arl" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Horas Nocturnas</label>
                    <input type="number" name="arl" id="arl" class="form-control">
                </div>
                <div class="col-md-6" align="right">
                    <input type="submit" class="btn btn-success btn-lg" name="enviar" id="enviar" value="Registrarse" />
                </div>
                <div class="col-md-6">
                    <input type="reset" class="btn btn-danger btn-lg"name="borrar" id="borrar" value="Restablecer" />
                </div>
            </form>
        </div>
    </div>

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
    $vaca = $_POST['vaca'];
    $domin = $_POST['domi'];
    $eps = $_POST['eps'];
    $arl = $_POST['arl'];
    $nocturna = $_POST['nocturn'];

    if(($days+$vaca+$eps+$arl)<=30){

        $devengados = total_devengados(salario_dias($saldo, $days), vacaciones($saldo, $vaca), auxilio_transporte($saldo), auxilio_alimentacion($saldo, $days), incapacidad($saldo, $eps), incapacidad($saldo, $arl), nocturno($saldo, $nocturna), dominicales($saldo, $domin));
        $deducciones = total_deducciones(salud_pension($saldo), fondo_solidaridad($saldo));
        $prima_ces = prima_cesantias($saldo, auxilio_transporte($saldo));
        $cMensual = costoMensual($devengados, total_pres($prima_ces, intereses($prima_ces,$days), vacaciones2($saldo)));
    
        //insertamos datos de registro al mysql xampp, indicando nombre de la tabla y sus atributos
        $instruccion_SQL = "INSERT INTO `empleado`(`Nombre`, `Cedula`, `Centro de costo`, `Cargo`, `Sueldo`, `Dias`, `salario_dias`, `vacacionesD`,
         `auxilio_transporte`, `Eps`,`arl`, `Rnocturno`,`Dominicales`,`auxilio_alimentacion`,`total_devengado`,`salud`,`pension`,`fondo_solidaridad_pensional`,`total_deduccions`,
         `total_nomina`,`prima`,`cesantias`,`intereses_cesantias`,`vacaciones`,`Totales`,`Costo_diario`,`costo_mensual`,`Costo_Anual`)
                            VALUES ('$nombre','$cedula','$ccosto','$cargo','$saldo','$days'," . salario_dias($saldo, $days) . ", ".vacaciones($saldo, $vaca)."," . auxilio_transporte($saldo) . "
                            ,".incapacidad($saldo, $eps).",".incapacidad($saldo,$arl).",".nocturno($saldo, $nocturna).",".dominicales($saldo, $domin)."," . auxilio_alimentacion($saldo, $days) . ",
                            '$devengados'," . salud_pension($saldo) . ", " . salud_pension($saldo) . ", " . fondo_solidaridad($saldo) . ",
                            '$deducciones', " . total_nomina($devengados, $deducciones) . ", '$prima_ces', '$prima_ces', ".intereses($prima_ces,$days).",
                            ".vacaciones2($saldo).", ".total_pres($prima_ces, intereses($prima_ces,$days), vacaciones2($saldo)).",
                            ".costoDiario($cMensual).", '$cMensual', ".costoAnual($cMensual).")";
    
        $resultado = mysqli_query($conex, $instruccion_SQL) or die ("Error en la consulta $sql".mysqli_error($conex));
        if ($resultado == 1) {
            echo "<script>alert('El usuario se registró correctamente')</script>";
        }
    }else{
        echo "<script>alert('Se ingresaron más de 30 días laborales')</script>";
    }

   
}

?>