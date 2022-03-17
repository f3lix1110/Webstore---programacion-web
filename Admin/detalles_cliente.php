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
<td> <input onclick='producto()' type='button' name='productos' id='productos' value='Productos' /> </td> 
<td> <input onclick='cierre()' type='button' name='salir' id='salir' value='Cerrar Sesion' /> </td>
</table> <br>";

$id_detalle = $_REQUEST['sd'];

$con = conecta();
 // SELECT (*) todas las columnas y filas
 $sql = "SELECT * FROM clientes WHERE id = $id_detalle AND eliminado = 0";
 $res = mysql_query($sql, $con);    //guardo en mi variable res consulta y conexion
 $num = mysql_num_rows($res);      //devuelve el numero de filas de la variable resultado (res)

     $id           = mysql_result($res, $i, "id");
     $nombre       = mysql_result($res, $i, "nombre");
     $apellidos    = mysql_result($res, $i, "apellidos");
     $correo    = mysql_result($res, $i, "correo");
     $archivo  = mysql_result($res, $i, "archivo");
     $archivo_n  = mysql_result($res, $i, "archivo_n");
     $pass  = mysql_result($res, $i, "pass");
     $status  = mysql_result($res, $i, "status");

     $status_txt = ($status == 0) ? 'Inactivo' : 'Activo';

    echo "<table border = 4 id=fila_$id class='tabla' align='center'>
     <tr> <td colspan='2' align='center'> ID: $id </td> </tr>
     <tr> <td colspan='2' align='center'> <img src = \"../archivos/clientes/$archivo_n\" width=\"400px\" heigth=\"280px\"></img> </td> </tr>
     <tr> <td align='center'> Nombre </td>  <td> $nombre </td> </tr>
     <tr> <td align='center'> Apellido </td> <td> $apellidos </td> </tr>
     <tr> <td align='center'> Correo </td> <td> $correo </td> </tr>
     <tr> <td align='center'> Clave </td> <td> $pass </td> </tr>
     <tr> <td align='center'> Archivo </td> <td> $archivo </td> </tr>
     <tr> <td align='center'> Archivo encriptado </td> <td> $archivo_n </td> </tr>
     <tr> <td align='center'> Status </td> <td> $status_txt </td> </tr> ";
        
     echo "</table> <br>";

?>