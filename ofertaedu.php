<?php
// Cambios, pagina en menu
include ("./inc/sesiones.php");
validarSesion();
include("./inc/header.php");
?>

<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Title of the document</title>
</head>
<body>
    <?php
    encabezado();
    menu();
    ?>
    <h1>Oferta Educativa</h1>
</body>
</html>
