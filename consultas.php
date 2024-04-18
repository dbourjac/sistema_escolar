<?php
// Conecta con la base de datos, si no, ahí muere
function conexion() {
    include ("config.php");
    $connection = mysqli_connect($HOST, $USER, $PSWD, $NAMEDB) or die;
    return $connection;
}
// Muestra la carrera en la que está inscrito el usuario
function mostrarCarrera(){
    include ("config.php");
    $query = "SELECT nombre FROM carreras WHERE id = (SELECT carrera_elegida FROM alumnos WHERE id = {$_SESSION['idAlumno']})";
    $resultado = mysqli_query(conexion(), $query) or die;
    if(mysqli_num_rows($resultado) > 0) {
        $row = mysqli_fetch_assoc($resultado);
        return $row['nombre'];
    } else {
        return null;
    }
}
// Muestra las carreras disponibles en la base de datos, y las muestra al usuario ya conectado
function obtenerTodasCarreras() {
    include ("config.php");
    $query = "SELECT id, nombre FROM carreras";
    $connection = conexion();
    $resultado = mysqli_query($connection, $query) or die(mysqli_error($connection));
    mysqli_close($connection);
    return $resultado;
}
?>
