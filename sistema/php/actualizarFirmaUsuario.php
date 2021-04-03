<?php

session_start();
include("../../db/Conexion.php");
$conexion = new Conexion();

$idUsuario = $_POST['idUsuario'];
$firma = $_POST['signature'];




$consultaSQL = "UPDATE usuario SET firma_usuario='$firma'WHERE id_usuario=$idUsuario";
$update = $conexion->editarDatos($consultaSQL);

$consultaSQL = "UPDATE usuario SET firma_usuario=REPLACE(firma_usuario,'image/svg+xml,','')";
        $insert = $conexion->editarDatos($consultaSQL);

        $_SESSION['firma'] = $firma;


echo ($update);
