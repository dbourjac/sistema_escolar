<?php
include_once("../inc/sesiones.php");
validarSesion();
include ("../inc/header.php");
include ("../inc/consultas.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscripción</title>
</head>
<body>
    <h1>Inscripción</h1> 
    <p>¡Hola, <?php echo $_SESSION["nombreUsuario"]; ?>! <br>
    Estás en proceso de inscribirte en una carrera.</p>
    <br>
    Selecciona la carrera deseada: 
    <br>
    <form action="accion_inscribir.php" method="POST">
        <select name="carrera">
        <?php
        $resultado = obtenerTodasCarreras();
        while ($row = mysqli_fetch_assoc($resultado)){
            echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
        }
        ?>
        </select>
        <input type="submit" value="Inscribirme">
    </form>
</body>
</html>
