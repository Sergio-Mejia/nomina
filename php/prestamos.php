<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Nomina</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div>
        <nav class=" navbar navbar-expand-md navbar-dark bg-dark fixed-top">
            <a class="navbar-brand" href="../index.php">Registar</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="./mostrar.php">Datos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Préstamos</a></li>
                </ul>
            </div>
        </nav>
    </div>
    <br><br><br>

    <div class="container">
        <div class="cont">
            <form action="" class="row g-3" method="post">
                <h1>Préstamos</h1>
                <hr class="bg bg-light">
                <div class="col-md-12">
                    <label class="form-label">Cedula</label>
                    <td><input type="number" name="cedula" id="cedula" class="form-control" required></td>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Monto</label>
                    <td><input type="number" name="monto" id="monto" class="form-control" required></td>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Cuotas</label>
                    <td><input type="number" name="cuotas" id="cuotas" class="form-control" required></td>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Cuotas Pagadas</label>
                    <td><input type="number" name="pago" id="pago" class="form-control" required></td>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Fecha</label>
                    <td><input type="date" name="fecha" id="fecha" class="form-control" required></td>
                </div>
                <div class="col-md-12" align="center">
                    <input type="submit" class="btn btn-success btn-lg" name="enviar" id="enviar" value="Registrar" />
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>

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

        $deducciones = "select `total_deduccions`, `total_nomina` from `empleado` where `Cedula`='$cedula'";
        $result =  mysqli_query($conex, $deducciones) or die("Error en la consulta $sql" . mysqli_error($conex));

        $row = mysqli_fetch_array($result);
        $ded = $row['total_deduccions'];
        $nom = $row['total_nomina'];

        $ded = $ded + $vcuota;
        $nom = $nom - $vcuota;

        $sql2 = "update `empleado` set `total_deduccions`= '$ded', `total_nomina`='$nom' where `Cedula` = '$cedula'";
        mysqli_query($conex, $sql2) or die("Error en la consulta $sql" . mysqli_error($conex));

        if ($resultado == 1) {
            echo "<script>alert('El usuario se registró correctamente')</script>";
        }
        mysqli_close($conex);
    }
}
?>