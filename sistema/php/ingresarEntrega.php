<?php

session_start();
include("../../db/Conexion.php");
$conexion = new Conexion();
$empleado = $_POST['empleado'];
$empresa = $_POST['empresa'];
$firma=$_POST['signature'];
$usuario = $_SESSION['iduser'];
$obs = $_POST['obs'];
$cantidades = $_POST['cantidad'];
$descripcion = $_POST['descripcion'];
$marca = $_POST['marca'];
$serial = $_POST['serial'];
$consultaSQL = "INSERT INTO entregas (empresa, empleado, usuario, observaciones, firma_empleado) 
    values ($empresa , $empleado, $usuario, '$obs','$firma')";
$insert = $conexion->agregarDatos($consultaSQL);

/* Ingreso de productos a la tabla de entrega_productos */
if ($insert == 1) {
    $consultaSQL = "SELECT max(id_entrega) as 'max' FROM entregas ";
    $result = $conexion->consultarDatos($consultaSQL);
    $max = $result[0]['max'];
    $contar = 0;

    foreach ($cantidades as $cantidad) {
        $consultaSQL = "INSERT INTO entregas_productos (entrega , cantidad, descripcion, marca, `serial`) VALUES ('$max','$cantidad','$descripcion[$contar]','$marca[$contar]','$serial[$contar]')";
        $insert = $conexion->agregarDatos($consultaSQL);
        $contar++;
    }
}



echo ($insert);
