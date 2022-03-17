<?php
session_start(); //cada vez que vayamos a hacer una sesion, debera ser la primera linea del php
require "conecta.php";

$con = conecta();
$ban = 1; // variable bandera

$correo = $_REQUEST['correo'];
$pass   = $_REQUEST['password'];
$pass_enc = md5($pass);
 

$sql = "SELECT * FROM clientes WHERE correo = '$correo' AND pass = '$pass_enc' AND eliminado = 0";

$res = mysql_query($sql, $con);
$num = mysql_num_rows($res); 

if ($num == 1) {

    $ban = 0;
    $idUC = mysql_result($res, 0, "id");
    $user = mysql_result($res, 0, "nombre").' '.mysql_result($res, 0, "apellidos"); //concatenamos nombre con apellido

    $_SESSION['idUC'] = $idUC;
    $_SESSION['user'] = $user;
    header ('Location: principal.php');
    echo "sales";
} 

$_SESSION['ban'] = $ban;
header ('location: index.php');
                            
?>