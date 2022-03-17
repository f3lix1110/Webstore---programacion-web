<?php
   
   ///IMPRIME ERRORES SI ALGUNO DE LOS DATOS ES ERRONEO EN LA CONEXION

  // if ($ambiente == '´PROD'){
       define("HOST",'localhost');
       define("BD",'cliente01');
       define("USER_BD",'root');
       define("PASS_BD",'root');

    function conecta(){
        if( !($con = mysql_connect(HOST,USER_BD,PASS_BD)) ){
            echo "Error conectado al servidor de BBDD";
            exit();
        }

    if( !mysql_select_db(BD,$con) ){
        echo "Error Seleccionado BD";
        exit();
    }
    return $con;
}
?>