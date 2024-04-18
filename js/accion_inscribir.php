<?php
include_once("../inc/config.php");
include_once("../inc/sesiones.php");
include_once("../inc/consultas.php");

validarSesion();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["carrera"])) {
        $carrera_id = $_POST["carrera"];
        $alumno_id = $_SESSION["idAlumno"];
        $conexion = conexion();
        $query = "UPDATE alumnos SET carrera_elegida = ? WHERE id = ?";
        $stmt = mysqli_prepare($conexion, $query);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ii", $carrera_id, $alumno_id);
            mysqli_stmt_execute($stmt);
if (mysqli_stmt_affected_rows($stmt) > 0) {
    echo "¡La inscripción se realizó con éxito!<br>";
    echo "Serás redireccionado en 3 segundos.<br>";
    echo "Por alguna razón no logro funcionar que redireccione en este host";
    echo "<br><br>";
    echo '<a href="../menu.php" class="btn">Volver a Menú</a>';
    exit();
} else {
    echo "No se realizó ningún cambio. Es posible que el alumno no exista o la carrera seleccionada sea inválida.";
}
            
            mysqli_stmt_close($stmt);
        } else {
            echo "Error al preparar la consulta.";
        }
        mysqli_close($conexion);
    } else {
        echo "No se recibió la información necesaria.";
    }
} else {
    echo "Acceso no permitido.";
}
?>
