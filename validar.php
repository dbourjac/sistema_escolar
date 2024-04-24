<?php
// Valida que los datos introducidos por el usuario coincidan con la base de datos
include("./inc/config.php");
include("./inc/sesiones.php");
if(isset($_POST["user"]) && isset($_POST["pswd"]) && isset($_POST["tipo_usuario"])) {
    $tipo_usuario = $_POST["tipo_usuario"];
    switch ($tipo_usuario){
        case 'alumno':
    $matricula = $_POST["user"];
    $contrasenia = $_POST["pswd"];
    $connection = mysqli_connect($HOST, $USER, $PSWD, $NAMEDB) or die("Error al conectar a la base de datos");
    $matricula = mysqli_real_escape_string($connection, $matricula);
    $contrasenia = mysqli_real_escape_string($connection, $contrasenia);
    $sql = "SELECT * FROM alumnos WHERE expediente = '$matricula' AND password = MD5('$contrasenia')";
    $result = mysqli_query($connection, $sql);
    if(mysqli_num_rows($result) == 1) {
        $fila = mysqli_fetch_assoc($result);
        $nombreUsuario = $fila['nombre'] . ' ' . $fila['apellido_paterno'] . ' ' . $fila['apellido_materno'];
        $idAlumno = $fila['id'];
        session_start();
        $_SESSION["validada"] = 1;
        $_SESSION["nombreUsuario"] = $nombreUsuario;
        $_SESSION["idAlumno"] = $idAlumno;
        $query = "SELECT carrera_elegida FROM alumnos WHERE id = $idAlumno";
        $result_carrera = mysqli_query($connection, $query);
        if(mysqli_num_rows($result_carrera) > 0) {
            $row_carrera = mysqli_fetch_assoc($result_carrera);
            $carrera_elegida = $row_carrera['carrera_elegida'];
            if(!empty($carrera_elegida)) {
                $_SESSION["carreraElegida"] = $carrera_elegida;
            }
        } else {
            header("Location: inscribir_carrera.php");
            exit();
        }
        header("Location: menu.php");
        exit();
    } else {
        header("Location: index.php?error=invalid_credentials");
        exit();
    }
    break;

    case 'academico':
    $matricula = $_POST["user"];
    $contrasenia = $_POST["pswd"];
    $connection = mysqli_connect($HOST, $USER, $PSWD, $NAMEDB) or die("Error al conectar a la base de datos");
    $matricula = mysqli_real_escape_string($connection, $matricula);
    $contrasenia = mysqli_real_escape_string($connection, $contrasenia);
    $sql = "SELECT * FROM académicos WHERE expediente = '$matricula' AND password = ('$contrasenia')";
    $result = mysqli_query($connection, $sql);
    if(mysqli_num_rows($result) == 1) {
        $fila = mysqli_fetch_assoc($result);
        $nombreUsuario = $fila['nombre'] . ' ' . $fila['apellido_paterno'] . ' ' . $fila['apellido_materno'];
        $idAlumno = $fila['id'];
        session_start();
        $_SESSION["validada"] = 1;
        $_SESSION["nombreUsuario"] = $nombreUsuario;
        $_SESSION["idAlumno"] = $idAlumno;
        $query = "SELECT carrera_elegida FROM alumnos WHERE id = $idAlumno";
        $result_carrera = mysqli_query($connection, $query);
        if(mysqli_num_rows($result_carrera) > 0) {
            $row_carrera = mysqli_fetch_assoc($result_carrera);
            $carrera_elegida = $row_carrera['carrera_elegida'];
            if(!empty($carrera_elegida)) {
                $_SESSION["carreraElegida"] = $carrera_elegida;
            }
        } else {
            header("Location: inscribir_carrera.php");
            exit();
        }
        header("Location: ./aca/menu_aca.php");
        exit();
    } else {
        header("Location: index.php?error=invalid_credentials");
        exit();
    }
    break;
        break;


    case 'administrativo';
    $matricula = $_POST["user"];
    $contrasenia = $_POST["pswd"];
    $connection = mysqli_connect($HOST, $USER, $PSWD, $NAMEDB) or die("Error al conectar a la base de datos");
    $matricula = mysqli_real_escape_string($connection, $matricula);
    $contrasenia = mysqli_real_escape_string($connection, $contrasenia);
    $sql = "SELECT * FROM administrativos WHERE expediente = '$matricula' AND password = ('$contrasenia')";
    $result = mysqli_query($connection, $sql);
    if(mysqli_num_rows($result) == 1) {
        $fila = mysqli_fetch_assoc($result);
        $nombreUsuario = $fila['nombre'] . ' ' . $fila['apellido_paterno'] . ' ' . $fila['apellido_materno'];
        $idAlumno = $fila['id'];
        session_start();
        $_SESSION["validada"] = 1;
        $_SESSION["nombreUsuario"] = $nombreUsuario;
        $_SESSION["idAlumno"] = $idAlumno;
        $query = "SELECT carrera_elegida FROM alumnos WHERE id = $idAlumno";
        $result_carrera = mysqli_query($connection, $query);
        if(mysqli_num_rows($result_carrera) > 0) {
            $row_carrera = mysqli_fetch_assoc($result_carrera);
            $carrera_elegida = $row_carrera['carrera_elegida'];
            if(!empty($carrera_elegida)) {
                $_SESSION["carreraElegida"] = $carrera_elegida;
            }
        } else {
            header("Location: inscribir_carrera.php");
            exit();
        }
        header("Location: ./adm/menu_adm.php");
        exit();
    } else {
        header("Location: index.php?error=invalid_credentials");
        exit();
    }
    break;
        break;
    }       
} else {
    header("Location: index.php?error=missing_data");
    exit();
}
?>
