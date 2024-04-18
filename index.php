<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Escolar</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <div id="login-form">
        <h1>Sistema Escolar</h1>
        <h2>de</h2>
        <h3>Dylan Bourjac</h3>
        <div class="login-links">
            <a href="#alumno">Alumno</a>
            <a href="#academico">Académico</a>
            <a href="#administrativo">Administrativo</a>
        </div>
        <form id="alumno" class="login-form" action="validar.php" method="POST">
            <input type="hidden" name="tipo_usuario" value="alumno">
            <label for="user">Expediente:</label>
            <input type="number" name="user" required>
            <label for="pswd">Contraseña:</label>
            <input type="password" name="pswd" required>
            <button type="submit">Iniciar Sesión</button>
        </form>
        <form id="academico" class="login-form" action="validar.php" method="POST">
            <input type="hidden" name="tipo_usuario" value="academico">
            <label for="user">Expediente:</label>
            <input type="number" name="user" required>
            <label for="pswd">Contraseña:</label>
            <input type="password" name="pswd" required>
            <button type="submit">Iniciar Sesión</button>
        </form>
        <form id="administrativo" class="login-form" action="validar.php" method="POST">
            <input type="hidden" name="tipo_usuario" value="administrativo">
            <label for="user">Expediente:</label>
            <input type="number" name="user" required>
            <label for="pswd">Contraseña:</label>
            <input type="password" name="pswd" required>
            <button type="submit">Iniciar Sesión</button>
        </form>
        <div class="register-link">
            ¿Aún no estás inscrito? ¡<a href="registro.php">Inscríbete aquí</a>!
        </div>
        <?php if (!empty($_GET["error"]) && $_GET["error"] == 100) {
            echo "<div class='error-message'>Se ha detectado un acceso indebido</div>";
        } ?>
    </div>
</body>
</html>
