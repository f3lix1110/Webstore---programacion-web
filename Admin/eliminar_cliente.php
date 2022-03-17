<?php
require "conecta.php";
$con = conecta();
$id=$_REQUEST['sd'];
$sql = "UPDATE clientes SET eliminado = 1 WHERE id = $id";
$res=mysql_query($sql,$con);
?>