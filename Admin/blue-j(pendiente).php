<?php

$(document).ready(function(){

    $ ("#correo").blur(function() {
    var correo = $(this).val();
    //$("#mensaje").html('Buscando el correo: '+correo);
    //setTimeout("$('#mensaje').html('')",8000);

    //Implementar ajax
    var existe = 1; //suponiendo que ya existe
    if (existe == 1) {
        $("#mensaje").html('El correo '+correo+' ya existe');
        $(this).val('')
    }
    
    });

});

?>