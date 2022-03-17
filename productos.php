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

                          function producto(){
                            var dominio = 'productos.php';
                            window.location.href=dominio;
                          }

                function cierre(){
                  var dominio = 'cierre.php';
                  window.location.href=dominio;
                }
  
                function agregar_productor(id_producto, cantidad){
                    alert("hola="+id_producto+"c="+cantidad);
                }

// cantidad = document.getElementById("cantidad").value;

function agregar_producto(id_producto, cantidad){

        $.ajax({
            url:'agregar_producto.php',
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

    } 
    </script>


</head>

<body> 
<!--FECHA-->
<div style="float:right;">

<script type="text/javascript">
var d=new Date();
var dia=new Array(7);
dia[0]="Domingo";
dia[1]="Lunes";
dia[2]="Martes";
dia[3]="Miercoles";
dia[4]="Jueves";
dia[5]="Viernes";
dia[6]="Sabado";
document.write("Dia: " + dia[d.getDay()]);
</script> 

<script type="text/javascript">
//<![CDATA[
var date = new Date();
var d  = date.getDate();
var day = (d < 10) ? '0' + d : d;
var m = date.getMonth() + 1;
var month = (m < 10) ? '0' + m : m;
var yy = date.getYear();
var year = (yy < 1000) ? yy + 1900 : yy;
document.write(day + "/" + month + "/" + year);
//]]>
</script>          </div>

Bienvenido <?php if($idUC!=''){ echo $user; }?>

<!--RECUADRO-->
<br><br>
<table border = 2 class='tabla' align='center'>
<td> <input onclick='producto()' type='button' name='productos' id='productos' value='Actualizar Productos' /> </td> 
<td> <input onclick='carrito()' type='button' name='carrito' id='carrito' value='Ver el carrito' /> </td>
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

<h1 align='center'> PRODUCTOS EN VENTA </h1>

<div class="fondo"> <!--fondo-->

<?php
$con = conecta();
$sql = "SELECT * FROM productos WHERE status = 1 AND eliminado = 0";
$res = mysql_query($sql, $con);    //guardo en mi variable res consulta y conexion
$num = mysql_num_rows($res);      //devuelve el numero de filas de la variable resultado (res)

    for ($i=0; $i<$num; $i++){ 
        $id_producto  = mysql_result($res, $i, "id");
        $nombre       = mysql_result($res, $i, "nombre");
        $stock        = mysql_result($res, $i, "stock");
        $costo        = mysql_result($res, $i, "costo");
        $costo        = '$'.number_format($costo, 2, '.',','); //para darle el formato al precio
        $imagen       = mysql_result($res, $i, "archivo_n");
        $imagen       = ($imagen) ? $imagen : 'Nodisponible.jpg'; // creara por defecto esta ruta de imagen
        ?>

<!--<form method='post' action='recibe_productos_2.php' enctype='multipart/form-data'>-->
<div class="cuadro"> 
    <div class="imagen"> <img src="archivos/productos/<?php echo $imagen; ?>" width="100%" height="100px"> </div>
    <div class="texto" align='center'> <?php echo $nombre ?> </div>
    <div class="texto" align='center'> Precio: <?php echo $costo ?> </div>
    <div class="texto" align='center'> Disponibles: <?php echo $stock ?> </div>
    
    <!--AGREGAR Y SU CANTIDAD-->
    <div class="agrega" align='center'> 
        <input id= "cantidad" type="number" name="cantidad" min="0" max="<?php echo $stock ?>" autofocus="autofocus" required="required" value="1" >
       
       <input onclick='agregar_producto(<?php echo $id_producto;?>, 1);return false;' type='button' name="agrega" value='Agregar'>
    </div>
</div>
<!--</form>-->

<?php } ?>

</div> <!-- div fondo -->
 
</body>


</html>