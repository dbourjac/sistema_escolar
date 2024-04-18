<?php
// Inscribir manualmente
include("./inc/config.php");
include("./inc/consultas.php");
$nombre = $_POST["nombre"];
$apellido_paterno = $_POST["apellido_paterno"];
$apellido_materno = $_POST["apellido_materno"];
$fecha_nac = $_POST["fecha_nac"];
$curp = $_POST["curp"];
$password = md5($_POST["password"]);
$expediente = generarExpedienteUnico();
$correo_inst = "a" . $expediente . "@unison.mx";

$connection = conexion();

$nombre = mysqli_real_escape_string($connection, $nombre);
$apellido_paterno = mysqli_real_escape_string($connection, $apellido_paterno);
$apellido_materno = mysqli_real_escape_string($connection, $apellido_materno);
$fecha_nac = mysqli_real_escape_string($connection, $fecha_nac);
$curp = mysqli_real_escape_string($connection, $curp);
$correo_inst = mysqli_real_escape_string($connection, $correo_inst);

$sql = "INSERT INTO alumnos (expediente, nombre, apellido_paterno, apellido_materno, fecha_nac, curp, correo_inst, password) VALUES ('$expediente', '$nombre', '$apellido_paterno', '$apellido_materno', '$fecha_nac', '$curp', '$correo_inst', '$password')";

$result = mysqli_query($connection, $sql);

if ($result) {
    session_start();
    $_SESSION["validadaRegistro"] = 1;
    header("Location: datos_usuario.php?nombre=$nombre&apellido_paterno=$apellido_paterno&apellido_materno=$apellido_materno&expediente=$expediente");
    exit();
} else {
    header("Location: index.php?registro=error");
    exit();
}
function generarExpedienteUnico() {
    $connection = conexion();
    $expediente = mt_rand(100000000, 999999999);
    $query = "SELECT expediente FROM alumnos WHERE expediente = '$expediente'";
    $result = mysqli_query($connection, $query);
    while (mysqli_num_rows($result) > 0) {
        $expediente = mt_rand(100000000, 999999999);
        $result = mysqli_query($connection, $query);
    }
    mysqli_close($connection);
    return $expediente;
}
?>
