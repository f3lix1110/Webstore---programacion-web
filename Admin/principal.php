<?php
//SESION
 session_start(); 
 $id = $_SESSION['idU'];
 $nomU = $_SESSION['nomU'];
 if($_SESSION['idU'] == ''){
  header("Location: index.php");
}
 echo "Usuario:  $nomU ";
 ?>
 
<html>

<head> 

<link href="css/estilo_lista_administrador.css" rel="stylesheet" type="text/css" >

<style> .table_1{
	width: 50%;
	height: 300px;
  text-align: center;
  background-color: orange;
  color: black;
  font-size: 200%;
} </style>

<script>

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
</script>

</head>

<body>

<br> <br>
<table border = 2 class='tabla' align='center'>
<td> <input onclick='inicio()' type='button' name='inicio' id='inicio' value='Inicio' /> </td>
<td> <input onclick='lista_admin()' type='button' name='administradores' id='administradores' value='Administradores' /> </td> 
<td> <input onclick='lista_cliente()' type='button' name='cliente' id='cliente' value='Clientes' /> </td>
<td> <input onclick='lista_pedido()' type='button' name='pedido' id='pedido' value='Pedidos' /> </td>
<td> <input onclick='producto()' type='button' name='productos' id='productos' value='Productos' /> </td> 
<td> <input onclick='cierre()' type='button' name='salir' id='salir' value='Cerrar Sesion' /> </td>
</table> <br>

<br> <br> <br>
<table border = 8 class='table_1' align='center'>
<td> <h1> BIENVENIDO <br> <?php echo " $nomU "; ?> </h1> </td>
</table>


</body>

</html>