$(document).ready(function() {

    // Función para cerrar los mensajes de éxito o error en el panel de control
    $('.cerrar_msg').click(function(e){
        
        e.preventDefault();
        $( ".dialogo" ).hide();
    });
});