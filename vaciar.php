<?php
session_start();
require "conecta.php";
$con = conecta();

$pedido = $_REQUEST['pedido'];

$sql = "DELETE FROM pedidos_productos WHERE id_pedido = $pedido ";
$res = mysql_query($sql,$con);
echo $res;   
?>