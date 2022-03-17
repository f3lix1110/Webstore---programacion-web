<?php
session_start();
require "conecta.php";
$con = conecta();

$pedido = $_REQUEST['pedido'];

$sql2 = "DELETE FROM pedidos_productos WHERE id_pedido = $pedido ";
$res2 = mysql_query($sql2,$con);

$sql = "DELETE FROM pedidos WHERE id = $pedido ";
$res = mysql_query($sql,$con);

echo $res;   
?>