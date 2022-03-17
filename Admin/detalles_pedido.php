<?php
require "conecta.php";
//SESION
session_start(); 
$id = $_SESSION['idU'];
$nomU = $_SESSION['nomU'];
if($_SESSION['idU'] == ''){
 header("Location: index.php");
}
echo "Usuario:  $nomU ";

  echo "<link href=\"css/estilo_lista_administrador.css\" rel=\"stylesheet\" type=\"text/css\" >"; 

  echo "<script src='js/jquery-3.3.1.min.js' >  </script>";
  echo " <script>                                 
  
                                                      function lista_pedido(){
                                                        var dominio = 'lista_pedido.php';
                                                        window.location.href=dominio;
                                                      }


                                                  function lista_cliente(){
                                                    var dominio = 'lista_cliente.php';
                                                    window.location.href=dominio;
                                                  }

                                            function inicio(){
                                              var dominio = 'principal.php';
                                              window.location.href=dominio;
                                            }
  
                                    function lista_admin(){
                                      var dominio = 'lista_administrador.php';
                                      window.location.href=dominio;
                                    }

                          function producto(){
                            var dominio = 'lista_producto.php';
                            window.location.href=dominio;
                          }

                function cierre(){
                  var dominio = 'cierre.php';
                  window.location.href=dominio;
                          }

  </script> ";

//RECUADRO
 echo "
<br> <br> <br>
<table border = 2 class='tabla' align='center'>
<td> <input onclick='inicio()' type='button' name='inicio' id='inicio' value='Inicio' /> </td>
<td> <input onclick='lista_admin()' type='button' name='administradores' id='administradores' value='Administradores' /> </td> 
<td> <input onclick='lista_cliente()' type='button' name='cliente' id='cliente' value='Clientes' /> </td>
<td> <input onclick='lista_pedido()' type='button' name='pedido' id='pedido' value='Pedidos' /> </td>
<td> <input onclick='producto()' type='button' name='productos' id='productos' value='Productos' /> </td> 
<td> <input onclick='cierre()' type='button' name='salir' id='salir' value='Cerrar Sesion' /> </td>
</table> <br>";

$id_detalle = $_REQUEST['sd'];

echo"<h1 align='center'> PRODUCTOS EN EL PEDIDO: $id_detalle <h1>";

echo" <div>";
$con = conecta();
 //SELECCIONO TODOS LOS PRODUCTOS PEDIDOS (PEDIDOS_PRODUCTOS)
 $sql = "SELECT * FROM pedidos_productos WHERE id_pedido = $id_detalle";
 $res = mysql_query($sql, $con);    //guardo en mi variable res consulta y conexion
 $num = mysql_num_rows($res);      //devuelve el numero de filas de la variable resultado (res)
 
    for($i = 0; $i < $num; $i++){
     $id           = mysql_result($res, $i, "id"); 
     $id_producto   = mysql_result($res, $i, "id_producto");
     $id_pedido    = mysql_result($res, $i, "id_pedido");
     $cantidad  = mysql_result($res, $i, "cantidad");

//SELECCIONO EL PRODUCTOS (DE LA TABLA PRODUCTOS)
 $sql2 = "SELECT * FROM productos WHERE id = $id_producto";
 $res2 = mysql_query($sql2, $con);  
 $num2 = mysql_num_rows($res2);  
      
      $nombre    = mysql_result($res2, 0, "nombre");
      $codigo    = mysql_result($res2, 0, "codigo");
      $descripcion   = mysql_result($res2, 0, "descripcion");
      $costo  = mysql_result($res2, 0, "costo");
      $Total = $costo * $cantidad;
      $archivo_n  = mysql_result($res2, 0, "archivo_n");
      $archivo_n       = ($archivo_n) ? $archivo_n : 'Nodisponible.jpg';
      
    echo "<table border = 4 class='tabla' align='center'>
     <tr> <td colspan='2' align='center'> ID DEL PRODUCTO: $id_producto </td> </tr>
     <tr> <td colspan='2' align='center'> <img src = \"../archivos/productos/$archivo_n\" width=\"200px\" heigth=\"100px\"></img> </td> </tr>
     <tr> <td align='center'> Nombre </td>  <td> $nombre </td> </tr>
     <tr> <td align='center'> Codigo </td> <td> $codigo </td> </tr>
     <tr> <td align='center'> Descripcion </td> <td> $descripcion </td> </tr>
     <tr> <td align='center'> Costo </td> <td> $$costo </td> </tr>
     <tr> <td align='center'> Cantidad </td> <td> $cantidad </td> </tr>
     <tr> <td align='center'> Subtotal: </td> <td> $$Total </td> </tr>
     <tr> <td align='center'> Status: </td> <td> En Orden </td> </tr> ";
      
     echo "</table> <br>"; 
    }//if
    echo" </div>";
   
?>