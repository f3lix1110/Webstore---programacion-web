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

  function elimina(id){
    if(confirm('Seguro desea cancelar este pedido?')){
       $.ajax({
           url:'cancela_pedido.php',
           type:'post',
           dataType:'text',
           data:'pedido='+id,
           success: function(res){
            if(res==1){ 
                $('.fila_'+id).hide(); 
            }else{
              alert('Error en la eliminacion'); 
            }
         },
       });
    }
}

 
                function enviar(id){
                  var dominio = 'detalles_pedido.php?sd='+id;
                  window.location.href=dominio;
                }
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
  
//SELECCIONO TODOS LOS PEDIDOS CON STATUS 1 (CONFIRMADOS)
 $con = conecta();
 // SELECT (*) todas las columnas y filas
 $sql = "SELECT * FROM pedidos WHERE status = 1";
 $res = mysql_query($sql, $con);    //guardo en mi variable res consulta y conexion
 $num = mysql_num_rows($res);      //devuelve el numero de filas de la variable resultado (res)

/*SELECCIONO TODOS LOS CLIENTES QUE SE ENCUENTREN EN PEDIDOS
 $sql = "SELECT * FROM clientes WHERE id = $pedidos";
 $res = mysql_query($sql, $con);    
 $num = mysql_num_rows($res);  */

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

//TITULO
echo"
<table border = 4 class='tabla' align='center'>
<td> <h1> PEDIDOS </h1> </td>
</table> <br>";

  echo "<table border = 2 class='tabla' align='center'>";
  echo "<td align='center'> Pedido </td> 
       <td align='center'> Fecha </td> 
       <td align='center'> Usuario </td>  
       <td align='center'> Estatus </td>
       <td colspan='2'; align='center'> Opciones </td>";

    //for que imprime todos los pedidos
     for($i = 0; $i < $num; $i++){
     $id           = mysql_result($res, $i, "id");
     $fecha       = mysql_result($res, $i, "fecha");
     $usuario    = mysql_result($res, $i, "usuario");
     $status     = mysql_result($res, $i, "status");

     $status_txt = ($status == 0) ? 'En Proceso' : 'Ordenado';

     echo "<tr class=fila_$id align='center'>
     <td> $id </td> 
     <td> $fecha </td>  <td> $usuario </td> <td> $status_txt </td>
     

     <td> <input onclick='enviar($id);' name='detalle' type='submit' value='Detalles'>
     
     <input onclick='elimina($id);return false;' type='submit' value='Cancelar' ></td>";
     echo "</tr>";
    }//for  

  echo "</table>";

?>