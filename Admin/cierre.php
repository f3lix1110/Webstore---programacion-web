<?php
 session_start();   //mandarle el nombre de la sesion e identificar
 session_destroy();    //cierre de sesion
 header ('location: index.php');   //me manda al listado de administradores
?>