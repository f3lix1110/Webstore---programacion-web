<?php
 //SESION
 session_start(); 
 $id = $_SESSION['idU'];
 $nomU = $_SESSION['nomU'];
 if($_SESSION['idU'] == ''){
  header("Location: index.php");
} 
 echo "Usuario:  $nomU "; ?>
<html>

    <head>
        <title>	Formulario </title>	
        <link rel="stylesheet" href="css/estilown.css">

      <script>

                                    function recibe() {
                                        var user = document.forma01.nombre.value;
                                      if(user) {
                                          document.forma01.method = 'post';
                                          document.forma01.action = 'recibe_cliente.php';
                                          document.forma01.submit();
                                      } else {
                                        alert('Error');
                                      }
                                     }//recibe

  function validacion(){
      
                          bandera = true;
          
                         document.getElementById("error_message_correo").style.display = "none";
                  document.getElementById("error_message_archivo").style.display = "none";
            document.getElementById("error_message_password").style.display = "none";

        nombre = document.getElementById("nombre").value;
          apellido = document.getElementById("apellido").value;
            correo = document.getElementById("correo").value;
              password = document.getElementById("password").value;
                  archivo = document.getElementById("archivo").value;
        
                                                    if( nombre == null || nombre.length == 0 || /^\s+$/.test(nombre) ) {
                                                        bandera = false;
                                                      // alert("Ingrese su nombre");
                                                    /*forzar al usuario a introducir un valor en un cuadro de texto o textarea en los que sea obligatorio */
                                                    }
                                              if( apellido == null || apellido.length == 0 || /^\s+$/.test(apellido) ) {
                                                  bandera = false;
                                                // alert("Ingrese su apellido");
                                              }
                                        if( password == null || password.length < 8 || /^\s+$/.test(password) ) {
                                            bandera = false;
                                            document.getElementById("error_message_password").style.display = "inline";
                                          // document.getElementById("error_message").innerHTML = "Su clave debe ser mayor a 8 caracteres";
                                          // alert("Su clave debe ser mayor a 8 caracteres");
                                        }
                                  if( !(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(correo)) ) { 
                                    bandera = false;
                                    document.getElementById("error_message_correo").style.display = "inline";
                                  // alert("Formato de correo invalido");
                                  } /* obligar al usuario a introducir una dirección de email con un formato válido */arguments
        

                          extensionesValidas = ".jpg";
                        extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase(); //con esto extraemos la extension del archivo
                      if (extensionesValidas != extension) {
                      bandera = false; 
                      document.getElementById("error_message_archivo").style.display = "inline";
                      //alert("La extension del archivo no es valido");
                      }

                if (bandera == false){
                    document.getElementById("error_message").style.display = "block";   ///mostramos el div que estaba oculto de forma predeterminada en el css
                }else{  //alert("Todo Correcto!");
                        recibe();
                     }
  }//validacion
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
        </script>
    
    </head>

<body>

<?php
 echo "
<br> <br> <br>
<table border = 2 class='tabla' align='center' style='background:grey'>
<td> <input onclick='inicio()' type='button' name='inicio' id='inicio' value='Inicio' /> </td>
<td> <input onclick='lista_admin()' type='button' name='administradores' id='administradores' value='Administradores' /> </td> 
<td> <input onclick='lista_cliente()' type='button' name='cliente' id='cliente' value='Clientes' /> </td>
<td> <input onclick='producto()' type='button' name='productos' id='productos' value='Productos' /> </td> 
<td> <input onclick='cierre()' type='button' name='salir' id='salir' value='Cerrar Sesion' /> </td>
</table> <br>";

//TITULO
echo"
<table border = 4 class='tabla' align='center' style= 'background-color: white; color: black'>
<td> <h1> NUEVO CLIENTE </h1> </td>
</table> <br>";
?>
  
  <form method="post" action="recibe_cliente.php" enctype="multipart/form-data">

          <input type="text" name="nombre" id="nombre" placeholder="Nombre"/><br><br>
          <input type="text" name="apellido" id="apellido" placeholder="Apellido"/><br><br>
          <input type="text" name="correo" id="correo" value="@" /> 
          <div id="error_message_correo"> Formato de email invalido </div> <br><br> 
          <input type="password" name="password" id="password" placeholder="Clave"/>
          <div id="error_message_password"> Su clave debe ser mayor a 8 caracteres </div> <br><br> 


                <p> Subir Imagen</p>
                <input type="file" id ="archivo" style="width:460;" name="archivo"> <br><br> 
                <div id="error_message_archivo"> La extension del archivo no es valido </div> <br><br> 

  <input onclick="validacion();return false;" style="width:100px; font-size:15; cursor:pointer;" 
   type="submit" value="Subir" name="submit">

                <br><br><br><div id="error_message">
                Campos Incompletos</div> 
                
  </form>

</body>

</html>