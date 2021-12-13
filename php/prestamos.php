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
        <a class="navbar-brand" href="../index.php">Registar</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="./mostrar.php">Datos</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Préstamos</a></li>
            </ul>
        </div>
    </nav>
    <br><br><br>

    <form action="" method="post">
        <table border="0" align="center">
            <tr>
                <td>Cédula</td>
                <td><input type="number" name="cedula" id="cedula"></td>
            </tr>
            <tr>
                <td>Monto</td>
                <td><input type="number" name="monto" id="monto"></td>
            </tr>
            <tr>
                <td>Cuotas</td>
                <td><input type="number" name="cuotas" id="cuotas"></td>
            </tr>
            <tr>
                <td>Cuotas pagadas</td>
                <td><input type="number" name="pago" id="pago"></td>
            </tr>
            <tr>
                <td>Fecha</td>
                <td><input type="date" name="fecha" id="fecha"></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" name="enviar" value="Registrar" id="enviar" class="btn btn-primary">
                </td>
            </tr>
        </table>
    </form>
    <?php

    include('./conexion.php');
    if (isset($_POST['enviar'])) {
        $conex = conectar();


        $cedula = $_POST['cedula'];
        $monto = $_POST['monto'];
        $cuotas = $_POST['cuotas'];
        $fecha = $_POST['fecha'];
        $cpago = $_POST['pago'];


        $vcuota = $monto / $cuotas;
        $cdescuento = $cuotas - $cpago;
        $saldo = (($cuotas - $cpago) * ($monto / $cuotas));


        if ($cuotas < $cpago) {
            echo "<script>alert('No es posible ingresar el número de cuotas pagadas')</script>";
        } else {
            $sql = "update `empleado` set `Monto`='$monto',`Cuotas`='$cuotas',`fecha`='$fecha',
                `cuotas_pagadas`='$cpago',`cuotas_descuento`='$cdescuento',`valor_cuota`='$vcuota',
                `saldoP` ='$saldo' where `Cedula` = '$cedula'";

            $resultado = mysqli_query($conex, $sql) or die("Error en la consulta $sql" . mysqli_error($conex));
            echo $resultado;

            

            if ($resultado == 1) {
                echo "<script>alert('El usuario se registró correctamente')</script>";
            }
        }
    }
    ?>

</body>

</html>