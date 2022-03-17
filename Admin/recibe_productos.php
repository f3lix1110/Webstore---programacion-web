<?php
require "conecta.php";

$nombre = $_POST['nombre'];
$codigo = $_POST['codigo'];
$descripcion = $_POST['descripcion'];
$costo    = $_POST['costo'];
$stock = $_POST['stock'];

    $file_name = $_FILES['archivo']['name']; //nombre real del archivo
    $file_tmp = $_FILES['archivo']['tmp_name'];//nombre temporal del archivo
    $cadena = explode(".",$file_name); //separa el nombre para obtener la extension
    $ext = $cadena[1]; //extension
    $dir = "../archivos/productos/"; //carpeta donde se guardaran los archivos
    $file_enc = md5_file($file_tmp); //nombre del archivo encriptado */

    if($file_name != ''){
        $fileName1 = "$file_enc.$ext"; /// asignamos una variable con el nombre encriptado y la extension
        @copy($file_tmp, $dir.$fileName1);  //copeamos el archivo en la direccion con el nombre (encriptado.extension)
    }

    $con = conecta();

    $sql = "INSERT INTO productos VALUES (0, '$nombre', '$codigo','$descripcion','$costo', $stock, '$fileName1','$file_name',1,0)"; //guardamos el nombre original del archivo, como el nuevo nombre

    $res = mysql_query($sql, $con);
 
    header("Location: lista_producto.php");
?>