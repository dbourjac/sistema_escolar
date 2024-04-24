<?php           
include_once("inc/header.php");
include("inc/sesiones.php");
include("inc/consultas.php");
validarSesion();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal de alumnos</title>
    <link rel="stylesheet" href="css/menu.css">
</head>
<body>
<div class="container">
    <div class="left-section">
        <div class="content">
            <div class="content-details">
                <?php
                encabezado();
                $carrera = mostrarCarrera();
                if ($carrera) {
                    echo  $carrera;
                } else {
                    echo "<p>Aún no estás inscrito en ninguna carrera.</p>";
                }
                menu();
                ?>
            </div>
            <div class="profile-image-container">
                <img class="profile-image" src="img/dilan.jpg" alt="Silueta de usuario">
            </div>
        </div>
    </div>
</div>
<div class="enmedio">
    <div class="enmedio-texto">
        <p>¡Hola, <?php echo htmlspecialchars($_SESSION["nombreUsuario"]); ?>! Has iniciado sesión exitosamente en el sistema escolar. ¡Bienvenido de vuelta!</p>
    </div>
</div>
<div class="top-section">
    <div class="header">
        <div class="portal-caja">
            <h1>Portal de alumnos</h1>
        </div>
        <nav>
            <?php menu2(); ?>
        </nav>
    </div>
</div>
</body>
</html>
