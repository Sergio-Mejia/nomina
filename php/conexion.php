<?php

function conectar(){
    
    $host="localhost"; 
    $user = "root";
    $password = ""; 
    $dbname="nominausuarios"; 

    //conectarnos a la base de datos
    $link = mysqli_connect($host, $user, $password) or die ("Error al conectar la BD ".mysqli_error($link));

    //Seleccionar BD
    mysqli_select_db($link, $dbname) or die ("Error al seleccionar BD".mysqli_error($link));

    return $link;
}

?>