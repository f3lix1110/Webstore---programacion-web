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
    if(confirm('Seguro desea eliminar este usuario?')){
       $.ajax({
           url:'eliminar.php',
           type:'post',
           dataType:'text',
           data:'sd='+id,
           success: function(res){
            if(res==1){
                alert('Error en la eliminacion');   
            }else{
                 $('.fila_'+id).hide();
            }
         },
       });
    }
}

function elimina2(){
  window.location.href='eliminar.php'; }

function enviar3(id){
  var dominio = 'formulario.php';
  window.location.href=dominio;
 }

      function enviar2(id){
       var dominio = 'modificar.php?sd='+id;
       window.location.href=dominio;
      }
 
                function enviar(id){
                  var dominio = 'detalles.php?sd='+id;
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
  
 $con = conecta();
 // SELECT (*) todas las columnas y filas
 $sql = "SELECT * FROM administradores WHERE status = 1 AND eliminado = 0";
 $res = mysql_query($sql, $con);    //guardo en mi variable res consulta y conexion
 $num = mysql_num_rows($res);      //devuelve el numero de filas de la variable resultado (res)

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
<td> <h1> ADMINISTRADORES </h1> </td>
</table> <br>";

//BOTON FORMULARIO
echo "
<input onclick='enviar3();' type='submit' name='regresa' style='width:auto; position: relative; left: 60%; font-size:18; cursor:pointer;' value='Agregar Nuevo' />
";

  echo "<table border = 2 class='tabla' align='center'>";
  echo "<td align='center'> Avatar </td>  <td align='center'> Nombre </td>  <td align='center'> Apellido </td> <td align='center'> Correo </td> <td colspan='3'; align='center'> Opciones </td>";
    //for que imprime todos los administradores
     for($i = 0; $i < $num; $i++){
     $id           = mysql_result($res, $i, "id");
     $nombre       = mysql_result($res, $i, "nombre");
     $apellidos    = mysql_result($res, $i, "apellidos");
     $correo    = mysql_result($res, $i, "correo");
     $archivo_n  = mysql_result($res, $i, "archivo_n");

     echo "<tr class=fila_$id align='center'>
     <td> <img src = \"../archivos/$archivo_n\" width=\"100px\" heigth=\"70px\"></img> </td> 
     <td> $nombre </td>  <td> $apellidos </td> <td> $correo </td>

     <td> <input onclick='enviar($id);' name='detalle' type='submit' value='Ver'>
    
     <input onclick='enviar2($id);' name='edita' type='submit' value='Editar' >
     
     <input onclick='elimina($id);return false;' type='submit' value='Eliminar' ></td>";
     echo "</tr>";
    }//for  

  echo "</table>";

?>