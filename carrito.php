<html>

<head> 

<?php
require "conecta.php";
//SESION
 session_start(); 
 $idUC = $_SESSION['idUC'];
 $user = $_SESSION['user'];
 if(!$_SESSION['user']){
  $cad1 = substr(str_shuffle("0123456789abcdefghijklmnopqrszuvwxyzABCDEFGHIJKLMNOPQRSTVWXY"), 0, 5);
  $cad2 = substr(md5(microtime()),1,10);
  $user = $cad1.$cad2;
  $_SESSION['user'] = $user;
}  else  {  $user = $_SESSION['user'];  }  ?>

<script src="js/jquery-3.3.1.min.js">  </script>
<link href="css/lista.css" rel="stylesheet" type="text/css">

<script>

                                                        function carrito(){
                                                        var dominio = 'carrito.php';
                                                        window.location.href=dominio;
                                                        }

                                            function vaciar(){
                                              var dominio = 'vaciar.php';
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

        function vaciarcarrito(pedido){
                    if(confirm('Seguro que deseas vaciar tu carrito?')){
                   $.ajax({
                       url: 'vaciar.php',
                       type:'post',
                       dataType:'text',
                       data: 'pedido='+pedido,
                       success:function(res){
                           if(res==1){
                              location.href='productos.php';
                           }else{
                               alert('Error en la eliminacion');
                           }
                       },error:function(){
                       alert('Error al conectar al servidor...');
                   }
                   });//termina Ajax();
                }//Termina confirm
            }

                            function deshacer(id_producto, cantidad){
                                $.ajax({
                                    url:'deshacer.php',
                                    type: 'post',
                                    dataType: 'text',
                                    data: 'id_producto='+id_producto+'&cantidad='+cantidad,
                                    success: function(res){
                                        if(res==1){
                                            alert('Error al agregar');
                                        } else {
                                            alert('Producto agregado');
                                        }
                                    },error:function(){
                                            alert('Error al conectar al servidor...');
                                        }
                                }); //Termina Ajax
                            }//function

            
                                        function Confirmar(pedido){
                                                if(confirm('Desea confirmar su pedido?')){
                                            $.ajax({
                                                url: 'confirmar.php',
                                                type:'post',
                                                dataType:'text',
                                                data: 'pedido='+pedido,
                                                success:function(res){
                                                    if(res==1){
                                                        alert('Pedido Confirmado!')
                                                        location.href='productos.php';
                                                    }else{
                                                        alert('Error en la confirmacion');
                                                    }
                                                },error:function(){
                                                alert('Error al conectar al servidor...');
                                            }
                                            });//termina Ajax();
                                            }//Termina confirm
                                        }
      
</script>

</head>

<body> 
    
Bienvenido <?php if($idUC!=''){ echo $user; }?> 

<?php
$con = conecta();
$sql ="SELECT * FROM pedidos WHERE usuario = '$user' AND status = 0";
$res = mysql_query($sql,$con);
$idP = mysql_result($res,$i,"id"); ?>

<!--RECUADRO-->
<br><br>
<table border = 2 class='tabla' align='center'>
<td> <input onclick='producto()' type='button' name='productos' id='productos' value='Productos' /> </td> 
<td> <input onclick='carrito()' type='button' name='carrito' id='carrito' value='Actualizar carrito' /> </td>
<td> <input onclick='vaciarcarrito(<?php echo $idP; ?>)' type='button' name='vaciar' id='vaciar' value='Vaciar el carrito' /> </td>
<?php 
if($idUC==''){
    echo"
    <td> <input onclick='cierre()' type='button' name='salir' id='salir' value='Iniciar Sesion' /> </td> ";
}else{
    echo"
    <td> <input onclick='cierre()' type='button' name='salir' id='salir' value='Cerrar Sesion' /> </td> ";
}
?>
</table> <br>

<h1 align='center'> PRODUCTOS EN TU CARRITO </h1>

<div class="fondo2"> <!--fondo-->

<?php

//Buscamos los productos con el ID del pedido actual
$sql1 = "SELECT * FROM pedidos_productos WHERE id_pedido = $idP";
$res1 = mysql_query($sql1, $con);    
$num1 = mysql_num_rows($res1);

    for ($i=0; $i<$num1; $i++){ 

        //Sacamos el id del producto y su cantidad
        $id_producto = mysql_result($res1, $i, "id_producto");
        $cantidad    = mysql_result($res1, $i, "cantidad");  


        $sql2 = "SELECT * FROM productos WHERE id = '$id_producto' ";
        $res2 = mysql_query($sql2, $con);    


        $nombreP      = mysql_result($res2, 0, "nombre");
        $id_Pro       = mysql_result($res2, 0, "id");
        $costo1       = mysql_result($res2, 0, "costo");
        $costo        = '$'.number_format($costo1, 2, '.',','); //para darle el formato al precio
        $imagen       = mysql_result($res2, 0, "archivo_n");
        $imagen       = ($imagen) ? $imagen : 'Nodisponible.jpg'; // creara por defecto esta ruta de imagen
        $precio_total = $costo1*$cantidad;

        $suma += $precio_total;
        ?>

<div class="cuadro"> 
    <div class="imagen"> <img src="archivos/productos/<?php echo $imagen; ?>" width="100%" height="100px"> </div>
    <div class="texto" align='center'> <?php echo $nombreP ?> </div>
    <div class="texto" align='center'> Precio: <?php echo $costo ?> </div>
    <div class="texto" align='center'> Cantidad: <?php echo $cantidad ?> </div>
    <div class="texto" align='center'> Total: $<?php echo $precio_total ?> </div>

    <!--AGREGAR Y SU CANTIDAD-->
    <div class="agrega" align='center'> 
            <select name="cantidad" id="cantidad" align='right'> 
                <?php for($u=1; $u<=$cantidad; $u++){ ?>
                    <?php echo "<option value='$u'> $u </option> "; ?>
                <?php } ?> 
            </select> 
                    <input onclick='deshacer(<?php echo $id_Pro;?>,1);return false;' type='button' name="agrega" value='deshacer'>
    </div>

</div>
<?php } 

if($num1==''){
    ?>   <h1 style="color: blue; text-align: center; -webkit-text-stroke: 1px black;"> <?php echo"NO HAZ AGREGADO NINGUN PRODUCTO";?> </h1> <?php
}else{
    ?>   <h1 style="color: blue; text-align: center; -webkit-text-stroke: 1px black;"> <?php echo"TOTAL DE TU COMPRA: $$suma";?> </h1>
    <input onclick='Confirmar(<?php echo $idP; ?>);return false;' style=" width:150px; de font-size:13; padding: 5px; border-radius: 10px; margin: 2%; cursor:pointer;" 
    type="submit" value="Confirmar compra">
<?php } ?>

</div> <!-- div fondo -->
 
</body>


</html>