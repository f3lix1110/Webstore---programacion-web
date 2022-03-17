<?php
require "conecta.php";

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellido'];
$correo = $_POST['correo'];
$rol    = $_POST['rol'];
$pass = $_POST['password'];
$pass_enc = md5($pass);
$rol_txt = ($rol == 1) ? 'Administrar' : 'Consultar';

    $file_name = $_FILES['archivo']['name']; //nombre real del archivo
    $file_tmp = $_FILES['archivo']['tmp_name'];//nombre temporal del archivo
    $cadena = explode(".",$file_name); //separa el nombre para obtener la extension
    $ext = $cadena[1]; //extension
    $dir = "../archivos/"; //carpeta donde se guardaran los archivos
    $file_enc = md5_file($file_tmp); //nombre del archivo encriptado */

    if($file_name != ''){
        $fileName1 = "$file_enc.$ext"; /// asignamos una variable con el nombre encriptado y la extension
        @copy($file_tmp, $dir.$fileName1);  //copeamos el archivo en la direccion con el nombre (encriptado.extension)
    }

   /* 
    echo "<br><br>";
    echo "";
    echo "<a href=\" archivos/$fileName1\">$file_name</a> <br>";  */

    $con = conecta();

    $sql = "INSERT INTO administradores VALUES (0, '$nombre', '$apellidos','$correo','$pass_enc', $rol, '$fileName1','$file_name',1,0)"; //guardamos el nombre original del archivo, como el nuevo nombre

    $res = mysql_query($sql, $con);
 
    header("Location: lista_administrador.php");
?>