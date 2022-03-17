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
                                          document.forma01.action = 'recibe_productos.php';
                                          document.forma01.submit();
                                      } else {
                                        alert('Error');
                                      }
                                     }//recibe producto

  function validacion(){
                
                          bandera = true;
          
                  document.getElementById("error_message_archivo").style.display = "none";
            document.getElementById("error_message_password").style.display = "none";

        nombre = document.getElementById("nombre").value;
          codigo = document.getElementById("codigo").value;
            descripcion = document.getElementById("descripcion").value;
              costo = document.getElementById("costo").value;
                stock = document.getElementById("stock").value;
                  archivo = document.getElementById("archivo").value;
        
                                                    if( nombre == null || nombre.length == 0 || /^\s+$/.test(nombre) ) {
                                                        bandera = false;
                                                    }
                                              if( descripcion == null || descripcion.length == 0 || /^\s+$/.test(descripcion) ) {
                                                  bandera = false;
                                              }
                                        if( codigo == null || codigo.length < 8 || /^\s+$/.test(codigo) ) {
                                            bandera = false;
                                            document.getElementById("error_message_password").style.display = "inline";
                                        }
                                  if( costo == null || costo.length == 0 || /^\s+$/.test(costo) ) {
                                  bandera = false;
                                //  document.getElementById("error_message_password").style.display = "inline";
                                  }
                             if( stock == null || stock.length == 0 || /^\s+$/.test(stock) ) {
                              bandera = false;
                          //  document.getElementById("error_message_password").style.display = "inline";
                            }     
                            

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
<table border = 2 class='tabla' align='center' style='background:grey';>
<td> <input onclick='inicio()' type='button' name='inicio' id='inicio' value='Inicio' /> </td>
<td> <input onclick='lista_admin()' type='button' name='administradores' id='administradores' value='Administradores' /> </td> 
<td> <input onclick='lista_cliente()' type='button' name='cliente' id='cliente' value='Clientes' /> </td>
<td> <input onclick='producto()' type='button' name='productos' id='productos' value='Productos' /> </td> 
<td> <input onclick='cierre()' type='button' name='salir' id='salir' value='Cerrar Sesion' /> </td>
</table> <br>";

//TITULO
echo"
<table border = 4 class='tabla' align='center' style= 'background-color: white; color: black;'>
<td> <h1> NUEVO PRODUCTO </h1> </td>
</table> <br>";
?>
  
  <form method="post" action="recibe_productos.php" enctype="multipart/form-data">

          <input type="text" name="nombre" id="nombre" placeholder="Nombre"/><br><br>
          <input type="text" name="codigo" id="codigo" placeholder="Codigo"/>
          <div id="error_message_password"> el codigo debe ser mayor a 8 caracteres </div> <br> <br>
          <input type="text" name="descripcion" id="descripcion" placeholder="Descripcion" style="width:50%; height:10%;"/> <br> <br>
          <input type="text" name="costo" id="costo" placeholder="$Costo"/> <br> <br>
          <input type="text" name="stock" id="stock" placeholder="En stock"/> <br> <br>
          

                <p> Subir Imagen</p>
                <input type="file" id ="archivo" style="width:100%;" name="archivo"> <br><br> 
                <div id="error_message_archivo"> La extension del archivo no es valido </div> <br><br> 

  <input onclick="validacion();return false;" style="width:100px; font-size:15; cursor:pointer;" 
   type="submit" value="Subir" name="submit">

                <br><br><div id="error_message">
                Campos Incompletos</div> 
                
  </form>

</body>

</html>