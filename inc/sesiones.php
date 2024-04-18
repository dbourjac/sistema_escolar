<?php
// Valida que los datos ingresados coincidan con la base de datos, si no, error y no puede acceder a nada 
// IMPORTANTE
function validarSesion(){
    session_start();
    if(empty($_SESSION["validada"]) || $_SESSION["validada"] != 1){
        header("Location: index.php?error=300");
        exit;
    }
}
// Lo mismo pero solamente cuando se registran
function validarSesionRegistro() {
    session_start();
    if (empty($_SESSION["validadaRegistro"]) || $_SESSION["validadaRegistro"] != 1) {
        header("Location: index.php?error=310");
        exit;
    }
}
?>
