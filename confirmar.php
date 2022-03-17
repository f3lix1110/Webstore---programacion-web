<?php
require "conecta.php";
session_start();
$con = conecta();

$idUC = $_SESSION['idUC'];
$user = $_SESSION['user'];

$pedido = $_REQUEST['pedido'];

///CAMBIAR EL VALOR DE STATUS DEL PEDIDO
$sql = "UPDATE pedidos SET status = 1 WHERE id = $pedido";
$res=mysql_query($sql,$con);
echo $res;

/* BORRAR LOS PRODUCTOS DEL PEDIDO
$sql1 = "DELETE FROM pedidos_productos WHERE id_pedido = $pedido ";
$res1 = mysql_query($sql1,$con); */

    //header ('location: productos.php');   //me manda al listado de productos
?> 