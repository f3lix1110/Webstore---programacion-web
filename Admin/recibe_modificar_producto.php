<?php
require "conecta.php";
session_start();

$id = $_SESSION['id_detalle'];

$nombre = $_POST['nombre'];
$codigo = $_POST['codigo'];
$descripcion = $_POST['descripcion'];
$costo    = $_POST['costo'];
$status = $_POST['status'];
$stock = $_POST['stock'];
$status_txt = ($status == 0) ? 'Inactivo' : 'Activo';


    $file_name = $_FILES['archivo']['name']; //nombre real del archivo
    $file_tmp = $_FILES['archivo']['tmp_name'];//nombre temporal del archivo
    $cadena = explode(".",$file_name); //separa el nombre para obtener la extension
    $ext = $cadena[1]; //extension
    $dir = "../archivos/productos/"; //carpeta donde se guardaran los archivos
    $file_enc = md5_file($file_tmp); //nombre del archivo encriptado */

    if($file_name != ''){
        $fileName1 = "$file_enc.$ext"; /// asignamos una variable con el nombre encriptado y la extension
        @copy($file_tmp, $dir.$fileName1);  //copeamos el archivo en la direccion con el nombre (encriptado.extension)
        $con = conecta();
        $sql = "UPDATE productos SET archivo_n = '$fileName1', archivo = '$file_name' WHERE id = $id";
        $res = mysql_query($sql, $con);
    }

    if($nombre != ''){
    $con = conecta();
    $sql = "UPDATE productos SET nombre = '$nombre' WHERE id = $id";
    $res = mysql_query($sql, $con);
    }


    if($costo != ''){
        $con = conecta();
        $sql = "UPDATE productos SET costo = '$costo' WHERE id = $id";
        $res = mysql_query($sql, $con);
        }

        if($descripcion != ''){
            $con = conecta();
            $sql = "UPDATE productos SET descripcion = '$descripcion' WHERE id = $id";
            $res = mysql_query($sql, $con);
            }

            if($codigo != 0){
                $con = conecta();
                $sql = "UPDATE productos SET codigo = '$codigo' WHERE id = $id";
                $res = mysql_query($sql, $con);
                }

                if($status != ''){
                    $con = conecta();
                    $sql = "UPDATE productos SET status = '$status' WHERE id = $id";
                    $res = mysql_query($sql, $con);
                    }

                    if($stock != ''){
                        $con = conecta();
                        $sql = "UPDATE productos SET stock = '$stock' WHERE id = $id";
                        $res = mysql_query($sql, $con);
                        }
 
   header("Location: lista_producto.php");
?>