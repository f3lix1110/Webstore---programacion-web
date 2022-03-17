<?php
session_start();
require "conecta.php";
$idUC = $_SESSION['idUC'];
$user = $_SESSION['user'];

$con = conecta();
$cantidad = $_REQUEST['cantidad'];
$id_producto = $_REQUEST['id_producto'];

//Saco el pedido del usuario actual
$sql1 = "SELECT * FROM pedidos WHERE usuario = '$user' AND status = 0";
$res1 = mysql_query($sql1, $con);
$id_pedido = mysql_result($res1, 0, "id"); //pedido

//buscamos si hay un mismo producto en un mismo pedido
$sql3 = "SELECT * FROM pedidos_productos WHERE id_pedido = $id_pedido AND id_producto = $id_producto"; 
$res3 = mysql_query($sql3, $con);
$num3 = mysql_num_rows($res3); 
$cantidad_actual = mysql_result($res3, 0, "cantidad");

$cantidad_nueva = $cantidad_actual-$cantidad;
$sql = "UPDATE pedidos_productos SET cantidad = $cantidad_nueva cantidad WHERE id_pedido = $pedido AND id_producto = $producto";
$res = mysql_query($sql,$con);
echo $res;
?>