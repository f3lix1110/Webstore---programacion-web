<html>

<head>
        <title>	Login </title>	
        <link rel="stylesheet" href="css/lista.css">

                <?php
                session_start();
                $ban = $_SESSION['ban'] ;
                if($_SESSION['ban'] == 1){
                  echo"<script> function myFunction(){
                    alert('usuario no encontrado!');
                    document.getElementById('error_message').style.display = 'block'; }
                  myFunction();  </script> ";
                }
                $_SESSION['ban'] = 0;
                ?>

  <script>
      
          function Invitado(){
            var dominio = 'principal.php';                                           
            window.location.href=dominio;
          }                                                                                   

                                                  function envio() {
                                                  var user = document.forma01.nombre.value;
                                                  if(user) {
                                                      document.forma01.method = 'post';
                                                      document.forma01.action = 'valida.php';
                                                      document.forma01.submit();
                                                  } else {
                                                      alert('Error');
                                                  }
                                                }

      function validacion(){
      
                              bandera = true;
          
                    document.getElementById("error_message_correo").style.display = "none";
                  document.getElementById("error_message_password").style.display = "none";
          
               password = document.getElementById("password").value;
            correo = document.getElementById("correo").value;
  
        
                          if( !(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(correo)) ) { 
                            bandera = false;
                            document.getElementById("error_message_correo").style.display = "inline";
                          }

                      if( password == null || password.length < 8 || /^\s+$/.test(password) ) {
                          bandera = false;
                          document.getElementById("error_message_password").style.display = "inline";
                      }

                  if (bandera == false){
                    document.getElementById("error_message").style.display = "block";   ///mostramos el div que estaba oculto de forma predeterminada en el css 
                  }else{
                    envio();
                  }
      }//validacion
  
  </script>
    
</head>

<body>

<h1 align="center"> Iniciar de Sesion </h1>
  
  <form method="post" action="valida.php" enctype="multipart/form-data">

  <p>Correo</p>
  <input type="text" name="correo" id="correo" value="@" /> 
  <div id="error_message_correo"> Email Incorrecto </div> <br><br> 

  <p>Clave</p>
  <input type="password" name="password" id="password" />
  <div id="error_message_password"> Clave Incorrecta </div> <br><br> 

  <input onclick="validacion();return false;" style="width:100px; border-radius: 10px; font-size:15; cursor:pointer;" 
   type="submit" value="Login" name="submit">

   <br><br><br><br><br><br><br><br><br><br><br>
   <input onclick="Invitado();return false;" style="width:200px; font-size:13; padding: 5px; border-radius: 10px; margin: 2%; cursor:pointer;" 
   type="submit" value="Iniciar como Invitado">

   <input onclick="Registro();return false;" disabled="disabled" style="width:200px; de font-size:13; padding: 5px; border-radius: 10px; margin: 2%; cursor:pointer;" 
   type="submit" value="Registrate">

  <script>  ///PENDIENTE

    $ ("#correo").blur(function() {
      var correo = $(this).val();
      $ ("#mensaje").html('Buscando el correo: '+correo);
      setTimeout("$('#mensaje').html('')",8000);

      //Implementar ajax
      //var existe = 1; //suponiendo que ya existe
      // if (existe == 1) {
      //  $("#mensaje").html('El correo '+correo+' ya existe');
      //  $(this).val('')
      //  }
      });
      
  </script>

    <br><br><br><div id="error_message">
    Error de autenticacion</div> 
    
    </form>

</body>

</html>