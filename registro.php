<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Alumnos</title>
    <link rel="stylesheet" href="css/registro.css">
</head>
<body>
    <h1>Registro de Alumnos</h1>
    <form action="procesar_registro.php" method="POST">
        <label for="nombre">Nombre/s:</label>
        <input type="text" id="nombre" name="nombre" required><br>
        <label for="apellido_paterno">Apellido Paterno:</label>
        <input type="text" id="apellido_paterno" name="apellido_paterno" required><br>
        <label for="apellido_materno">Apellido Materno:</label>
        <input type="text" id="apellido_materno" name="apellido_materno" required><br>
        <label for="fecha_nac">Fecha de Nacimiento:</label>
        <input type="date" id="fecha_nac" name="fecha_nac" required><br>
        <label for="curp">CURP:</label>
        <input type="text" id="curp" name="curp" required><br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br>
        <button type="submit">Registrarse</button>
        <a href="index.php" class="back-button">Volver</a>
        <a href="dummy.php" class="dummy-button">Dummy data</a>
    </form>
</body>
</html>
