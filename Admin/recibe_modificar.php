<?php
require "conecta.php";
session_start();

$id = $_SESSION['id_detalle'];

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellido'];
$correo = $_POST['correo'];
$rol    = $_POST['rol'];
$status = $_POST['status'];
$pass = $_POST['password'];
$pass_enc = md5($pass);
$rol_txt = ($rol == 2) ? 'Consultar' : 'Administrar';
$status_txt = ($status == 0) ? 'Inactivo' : 'Activo';


    $file_name = $_FILES['archivo']['name']; //nombre real del archivo
    $file_tmp = $_FILES['archivo']['tmp_name'];//nombre temporal del archivo
    $cadena = explode(".",$file_name); //separa el nombre para obtener la extension
    $ext = $cadena[1]; //extension
    $dir = "../archivos/"; //carpeta donde se guardaran los archivos
    $file_enc = md5_file($file_tmp); //nombre del archivo encriptado */

    if($file_name != ''){
        $fileName1 = "$file_enc.$ext"; /// asignamos una variable con el nombre encriptado y la extension
        @copy($file_tmp, $dir.$fileName1);  //copeamos el archivo en la direccion con el nombre (encriptado.extension)
        $con = conecta();
        $sql = "UPDATE administradores SET archivo_n = '$fileName1', archivo = '$file_name' WHERE id = $id";
        $res = mysql_query($sql, $con);
    }

    if($nombre != ''){
    $con = conecta();
    $sql = "UPDATE administradores SET nombre = '$nombre' WHERE id = $id";
    $res = mysql_query($sql, $con);
    }


    if($apellidos != ''){
        $con = conecta();
        $sql = "UPDATE administradores SET apellidos = '$apellidos' WHERE id = $id";
        $res = mysql_query($sql, $con);
        }

        if($correo != ''){
            $con = conecta();
            $sql = "UPDATE administradores SET correo = '$correo' WHERE id = $id";
            $res = mysql_query($sql, $con);
            }

            if($rol != 0){
                $con = conecta();
                $sql = "UPDATE administradores SET rol = '$rol' WHERE id = $id";
                $res = mysql_query($sql, $con);
                }

                if($status != ''){
                    $con = conecta();
                    $sql = "UPDATE administradores SET status = '$status' WHERE id = $id";
                    $res = mysql_query($sql, $con);
                    }

                    if($pass != ''){
                        $con = conecta();
                        $sql = "UPDATE administradores SET pass = '$pass_enc' WHERE id = $id";
                        $res = mysql_query($sql, $con);
                        }
 
   header("Location: lista_administrador.php");
?>