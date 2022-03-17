<?php
require "conecta.php";
$con = conecta();
session_start(); 
$idUC = $_SESSION['idUC'];
$user = $_SESSION['user'];

//echo"->$user";

$id_producto = $_REQUEST['id_producto'];
//echo"->$id_producto";
 //$fecha = $_POST['fecha'];
 $cantidad = $_REQUEST['cantidad'];
// echo"->$cantidad";

///INSERCION A LA TABLA "PEDIDOS" (id,fecha,usuario,status)
$sql1 = "SELECT * FROM pedidos WHERE usuario = '$user' AND status = 0";
$res1 = mysql_query($sql1, $con);
$num1 = mysql_num_rows($res1); 

//si existe el pedido con usuario y esta activo, 
//del resultado obtendremos el id del pedido, para posteriormente ingresarlo a la tabla pedidos_productos
$id_pedido = mysql_result($res1, 0, "id"); //Obtenemos el id del pedido (2)

//echo"->$id_pedido";
//echo"-> num: $num1";

if ($num1 == 0) { ///si no existe un pedido con ese usuario y ademas su status no es activo
    $sql5 = "INSERT INTO pedidos VALUES (0, 0, '$user', 0)"; //INSERTAMOS el pedido
    $res5 = mysql_query($sql5, $con);
    $sql2 = "SELECT * FROM pedidos WHERE usuario = '$user' AND status = 0"; //Seleccionamos el pedido
    $res2 = mysql_query($sql2, $con);
    $id_pedido = mysql_result($res2, 0, "id"); //Obtenemos el id del pedido (1)
    echo"-> pedido: $id_pedido";
}

//echo"-> pedido: $id_pedido";
///INSERCION A LA TABLA "PEDIDOS_PRODUCTOS" (id,id_pedido,id_producto,cantidad)

$sql3 = "SELECT * FROM pedidos_productos WHERE id_pedido = $id_pedido AND id_producto = $id_producto"; 
//buscamos si hay un mismo producto en un mismo pedido
$res3 = mysql_query($sql3, $con);
$num3 = mysql_num_rows($res3); 
$cantidad_actual = mysql_result($res3, 0, "cantidad");

//echo "->$num3";
//echo "->$cantidad_actual";

    if($num3 > 0){ //si el resultado es distinto de 0 es que si exite un producto en un mismo pedido

        //$id = mysql_result($res3, 0, "id"); //Obtengo el id de pedidos_productos (consulta anterior)
        $cantidad_nueva = $cantidad+$cantidad_actual;
        $sql = "UPDATE pedidos_productos SET cantidad = $cantidad_nueva WHERE id_pedido = $id_pedido AND id_producto = $id_producto"; 
        $res = mysql_query($sql, $con); ///entonces haremos update de la cantidad y le incrementaremos lo que sean que haya pedido
        //echo "->$cantidad";
        }else{ ///Caso contrario insertaremos el producto a la tabla con su pedido y cantidad
            $sql = "INSERT INTO pedidos_productos VALUES (0, $id_pedido,$id_producto,$cantidad)";
            $res = mysql_query($sql, $con);
        } 

   // header ('location: productos.php');   //me manda al listado de productos
?> 