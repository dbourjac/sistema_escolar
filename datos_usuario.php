<?php
// Datos del usuario que acaba de registrarse
include ("./inc/sesiones.php");
validarSesionRegistro();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos del Usuario</title>
    <link rel="stylesheet" href="css/registro.css">
</head>
<body>
    <h1>Datos del Usuario</h1>
    <p>¡Felicidades! Te has registrado exitosamente en el sistema.</p>
    <p>A continuación se muestran tus datos:</p>
    <ul>
        <li>Nombre: <?php echo $_GET["nombre"]; ?></li>
        <li>Apellido Paterno: <?php echo $_GET["apellido_paterno"]; ?></li>
        <li>Apellido Materno: <?php echo $_GET["apellido_materno"]; ?></li>
        <li>Expediente: <?php echo $_GET["expediente"]; ?></li>
    </ul>
    <a href="index.php">Volver a Inicio</a>
</body>
</html>
