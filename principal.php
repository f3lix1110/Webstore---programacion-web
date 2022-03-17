<?php
//SESION
 session_start(); 
 $idU = $_SESSION['idUC'];
 $user = $_SESSION['user'];

 ?>
 
<html>

<head> 

<link href="css/lista.css" rel="stylesheet" type="text/css" >

<script>
                                            function inicio(){
                                              var dominio = 'principal.php';
                                              window.location.href=dominio;
                                            }

                          function producto(){
                            var dominio = 'productos.php';
                            window.location.href=dominio;
                          }

                function cierre(){
                  var dominio = 'cierre.php';
                  window.location.href=dominio;
                          }
</script>

</head>

<body>

<br> <br> <br>
<table border = 2 class='tabla' align='center'>
<td> <input onclick='inicio()' type='button' name='inicio' id='inicio' value='Inicio' /> </td>
<td> <input onclick='producto()' type='button' name='productos' id='productos' value='Productos' /> </td> 
<?php
if($user!=''){
    echo" 
    <td> <input onclick='cierre()' type='button' name='salir' id='salir' value='Cerrar Sesion' /> </td> ";
}else{
    echo"
    <td> <input onclick='cierre()' type='button' name='salir' id='salir' value='Iniciar Sesion' /> </td> ";
} ?>
</table> <br>

<br> <br> <br>
<table border = 8 class='table_1' align='center'>
<td> <h1> BIENVENID@ <br> <?php echo " $user "; ?> </h1> </td>
</table>


</body>

</html>