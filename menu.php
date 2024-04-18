<?php
// Pagina principal del portal
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
    <title>Inicio de Sesión Exitoso</title>
    <link rel="stylesheet" href="css/menu.css">
</head>
<body>
    <nav>
        <?php menu2(); ?>
    </nav>
    <div class="content">
        <h1>Bienvenido al Sistema Escolar</h1>
        <p>¡Hola, <?php echo $_SESSION["nombreUsuario"]; ?>! Has iniciado sesión exitosamente en el sistema escolar. ¡Bienvenido de vuelta!</p>
        <?php
        encabezado();
        menu();
        $carrera = mostrarCarrera();
        if($carrera) {
            echo "<p>Estás inscrito en la carrera de: " . $carrera . "</p>";
        } else {
            echo "<p>Aún no estás inscrito en ninguna carrera.</p>";
        }
        ?>
        <a href="logout.php">Cerrar Sesión</a>
    </div>
</body>
</html>
