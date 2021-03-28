<?php

session_start();
include("Conexion.php");

$conectar = new Conexion();
//Se envia los datos mediante el ajax
$user = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$pass = (isset($_POST['password'])) ? $_POST['password'] : '';

//consulta SQL
$consultaSQL = "SELECT id_usuario, nombre_usuario, usuario_sesion, correo_usuario, firma_usuario FROM usuario 
WHERE usuario_sesion= '$user' AND clave= '$pass'";

$data = $conectar->consultarDatos($consultaSQL);

if ($data) {
    $_SESSION['active'] = true;
    $_SESSION['iduser'] = $data[0]['id_usuario'];
    $_SESSION['nombre'] = $data[0]['nombre_usuario'];
    $_SESSION['user'] = $data[0]['usuario_sesion'];
    $_SESSION['correo'] = $data[0]['correo_usuario'];
    $_SESSION['firma'] = $data[0]['firma_usuario'];


    echo json_encode(1);
} else {
    echo json_encode(-1);
}
