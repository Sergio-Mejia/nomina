<?php

//devengados
function salario_dias($salario, $dias){
    return ($salario/30) * $dias;

} 


function auxilio_transporte($salario){
    if($salario>=1817052){
        return 0;
    }else{
        return 106454;
    }
}


function auxilio_alimentacion($salario,$dias){
    
    if($dias=0 || $salario>=1873000){
        return 0;
    }else{
        return 66098;
    }
}

function total_devengados($salario, $vacaciones, $auxiolio_transporte, $auxiolio_alimento, $pagoARL, $pagoEPS, $recargo_Noc, $Dominicales){
    return $salario + $vacaciones + $auxiolio_transporte + $auxiolio_alimento + $pagoARL + $pagoEPS +  $recargo_Noc + $Dominicales;
}

function vacaciones($salario, $dias_va){
    return ($salario/30) *$dias_va;
}

//deducciones

function salud_pension($salario){
    return $salario * 0.04;
}

function fondo_solidaridad($salario){
    $minimo = 908526;
    if($salario>$minimo*4){
        return $salario * 0.01;
    }else{
        return 0;
    }
}

function total_deducciones($salud, $fondo){
    return ($salud*2) + $fondo;
}

function total_nomina($devengado, $deducciones){
    return $devengado - $deducciones;

}

//prestaciones 
function prima_cesantias ($salario, $aux_transporte){
    return ($salario + $aux_transporte) * 0.0833;
} 

function intereses($cesantias, $dias){
    return ($cesantias * $dias * 0.12)/360;
}

function vacaciones2 ($salario){
    return $salario * 0.0417;
}

function total_pres($prima, $intereses, $vacaciones){
    return ($prima*2) + $intereses + $vacaciones;
}


//costos
function costoMensual($dellatePre, $totalDevengado){
  return $dellatePre + $totalDevengado;  
}


function costoAnual($costoMesual){
    return $costoMesual *12;
}

function costoDiario($costoMesual){
    return $costoMesual/30;
}

function incapacidad($sueldo, $dias){
    $sdia = $sueldo/30;
    $aux = $sdia*0.66; 
    return $aux*$dias;
}

function nocturno($sueldo, $horas){
    $hora = ($sueldo/30)/8;
    $recargo = $hora * 0.35;
    return $recargo * $horas;
}

function dominicales($sueldo, $horas){
    $hora = ($sueldo/30)/8;
    $recargo = $hora * 0.75;
    return $recargo * $horas;
}

?>