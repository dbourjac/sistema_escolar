<?php
// Inscribir a carreras
session_start();
include ("./inc/consultas.php");
if(isset($_POST["carrera"]) && isset($_SESSION["Expediente"])) {
    $idCarrera = $_POST["carrera"];
    $idAlumno = $_SESSION["Expediente"];
    $consulta = "INSERT INTO carreras_alumnos (IDCarrera, IDAlumno) VALUES (?, ?)";
    $conexion = conexion();
    $stmt = mysqli_prepare($conexion, $consulta);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ii", $idCarrera, $idAlumno);

        $exito = mysqli_stmt_execute($stmt);

        if ($exito) {
            header("Location: menu.php");
            exit();
        } else {
            echo "Error al insertar datos en la base de datos.";
        }
    } else {
        echo "Error al preparar la consulta SQL.";
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
} else {
    header("Location: index.php?error=missing_data");
    exit();
}
?>
