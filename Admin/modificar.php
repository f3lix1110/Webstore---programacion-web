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

$id_detalle = $_REQUEST['sd'];

$_SESSION['id_detalle'] = $id_detalle;

  echo "<link href=\"css/estilo_lista_administrador.css\" rel=\"stylesheet\" type=\"text/css\" >";

  echo "<script src='js/jquery-3.3.1.min.js' >  </script>";
  echo " <script> 

  
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

                                                function lista_cliente(){
                                                  var dominio = 'lista_cliente.php';
                                                  window.location.href=dominio;
                                                }
                                                
                                                          function recibe() {
                                                            var user = document.forma01.nombre.value;
                                                            if(user) {
                                                                document.forma01.method = 'post';
                                                                document.forma01.action = 'recibe_modificar.php';
                                                                document.forma01.submit();
                                                            } else {
                                                                alert('Error');
                                                            }
                                                          }

              function validacion(){
      
                        bandera = true;
                                                              
                              document.getElementById('error_message_correo').style.display = 'none';
                                document.getElementById('error_message_archivo').style.display = 'none';
                                  document.getElementById('error_message_password').style.display = 'none';
                                                      
      password = document.getElementById('password').value;
        correo = document.getElementById('correo').value;
            archivo = document.getElementById('archivo').value;
                                                            
                      if (password != '') {
                    if( password.length < 8 ) {
                          bandera = false;
                          document.getElementById('error_message_password').style.display = 'inline';
                    }
                      }
                                                            
                                              if (correo != '') {
                                            if( !(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(correo)) ) { 
                                                  bandera = false;
                                                  document.getElementById('error_message_correo').style.display = 'inline';
                                            } 
                                              }
                                                            
                                                            if (archivo != '') {
                                                               extensionesValidas = '.jpg';
                                                               extension = (archivo.substring(archivo.lastIndexOf('.'))).toLowerCase();
                                                          if (extensionesValidas != extension) {
                                                              bandera = false; 
                                                              document.getElementById('error_message_archivo').style.display = 'inline';
                                                          }
                                                             }
                                                      
                        if (bandera == true){                 
                          recibe();
                        }
                                                        
              }//validacion

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

$con = conecta();
 // SELECT (*) todas las columnas y filas
 $sql = "SELECT * FROM administradores WHERE id = $id_detalle AND eliminado = 0";
 $res = mysql_query($sql, $con);    //guardo en mi variable res consulta y conexion
 $num = mysql_num_rows($res);      //devuelve el numero de filas de la variable resultado (res)

     $id           = mysql_result($res, $i, "id");
     $nombre       = mysql_result($res, $i, "nombre");
     $apellidos    = mysql_result($res, $i, "apellidos");
     $correo    = mysql_result($res, $i, "correo");
     $archivo  = mysql_result($res, $i, "archivo");
     $archivo_n  = mysql_result($res, $i, "archivo_n");
     $pass  = mysql_result($res, $i, "pass");
     $rol  = mysql_result($res, $i, "rol");
     $status  = mysql_result($res, $i, "status");

     $rol_txt = ($rol == 2) ? 'Consultar' : 'Administrar';
     $status_txt = ($status == 0) ? 'Inactivo' : 'Activo';

    echo "<table border = 4 class='tabla' align='center'>
    
    <form method='post' action='recibe_modificar.php' enctype='multipart/form-data'>
    
     <tr> <td colspan='3' align='center'> ID: $id </td> </tr>
     <tr> <td colspan='2' align='center'> <img src = \"../archivos/$archivo_n\" width=\"400px\" heigth=\"280px\"></img> </td> 
     
     <td colspan='2' align='middle'>
     <input type='file' id ='archivo' name='archivo'> <br><br> 
     <div class='error' id='error_message_archivo'> La extension del archivo no es valido </div> <br> </td> </tr>

     <tr> <td colspan='2' align='center'> Nombre: </td>
     <td align='middle'> 
     <input type='text' name='nombre' id='nombre' value='$nombre' placeholder='Nuevo Nombre'/>
     <div class='error' id='error_message_1'>
     Campo necesario</div>     
     </td> </tr>

     <tr> <td colspan='2' align='center'> Apellido: </td> 
     <td align='middle'> 
     <input type='text' name='apellido' id='apellido' value='$apellidos' placeholder='Nuevo Apellido'/>
     <div class='error' id='error_message_2'>
     Campo necesario</div> 
     </td> </tr>

     <tr> <td colspan='2' align='center'> Correo: </td>
     <td align='middle'> 
     <input type='text' name='correo' id='correo' value='$correo' placeholder='nuevo@correo.com' /> 
     <div class='error' id='error_message_correo'> Formato de email invalido </div>
     <div class='error' id='error_message_correo_2'> Campo necesario </div>
     </td> </tr>

     <tr> <td colspan='2' align='center'> Contrasena: </td> 
     <td align='middle'> 
     <input type='password' name='password' id='password' value='$pass' placeholder='Nueva Clave'/>
     <div class='error' id='error_message_password'> Minimo 8 caracteres </div>
     <div class='error' id='error_message_password_2'> Campo necesario </div>
     </td> </tr>

     <tr> <td colspan='2' align='center'> Rol: </td> 
     <td align='middle'> 
     <select name='rol' id='rol'>
     <option> $rol_txt </option>
     ";if($rol == 2){ echo"
     <option value='1'>Administrar </option>"; }
     if($rol == 1){ echo"
     <option value='2'>Consultar</option>"; }
     echo "</select>
     <div class='error' id='error_message_3'>
     Seleccione rol</div> 
     </td> </tr>


     <tr> <td colspan='2' align='center'> Status: </td>
     <td align='middle'>
     <select name='status' id='status'>
     <option value='1'> $status_txt </option>
     ";if($status == 0){ echo"
     <option value='1'>Activo </option>"; }
     if($status == 1){ echo"
     <option value='0'>Inactivo </option>"; }
     echo "</select>
     <div class='error' id='error_message_4'>
     Seleccione status</div> 
     </td> </tr>
  
     <tr> <td colspan='3' align='middle'>
     <input onclick='validacion();return false;' type='submit' value='Save'> </td> </tr>

     </form>";

     echo "</table> <br>";

?>