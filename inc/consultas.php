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
    $query = "SELECT id, nombre, costo FROM carreras";
    $connection = conexion();
    $resultado = mysqli_query($connection, $query) or die(mysqli_error($connection));
    mysqli_close($connection);
    return $resultado;
}

// Obtiene todas las materias con el nombre de la carrera asociada, se usa en la tabla "Materias de administrativo"
function obtenerMateriasConCarrera() {
    include ("config.php");
    $query = "SELECT materias.id, materias.nombre, materias.descripcion, carreras.nombre AS nombre_carrera 
              FROM materias 
              INNER JOIN carreras ON materias.carrera_id = carreras.id";
    $connection = conexion();
    $resultado = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $materias = array();
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $materias[] = $fila;
    }
    mysqli_close($connection);
    return $materias;
}

// Agrega una nueva materia a la base de datos
function agregarMateria($nombre, $descripcion, $carrera_id) {
    include("config.php");
    $connection = conexion();
    
    // Escapar caracteres especiales para evitar inyección SQL
    $nombre = mysqli_real_escape_string($connection, $nombre);
    $descripcion = mysqli_real_escape_string($connection, $descripcion);
    
    // Verificar si la materia ya existe
    $query_check = "SELECT COUNT(*) AS count FROM materias WHERE nombre = '$nombre'";
    $result_check = mysqli_query($connection, $query_check);
    $row_check = mysqli_fetch_assoc($result_check);
    
    if ($row_check['count'] > 0) {
        $_SESSION['mensaje'] = "Ya existe una materia con el mismo nombre.";
    } else {
        // Preparar la consulta SQL para insertar la nueva materia
        $query_insert = "INSERT INTO materias (nombre, descripcion, carrera_id) VALUES ('$nombre', '$descripcion', '$carrera_id')";
        
        // Ejecutar la consulta de inserción
        if(mysqli_query($connection, $query_insert)) {
            $_SESSION['mensaje'] = "Materia agregada correctamente.";
        } else {
            $_SESSION['mensaje'] = "Error al agregar la materia: " . mysqli_error($connection);
        }
    }
    
    // Cerrar la conexión
    mysqli_close($connection);
    
    // Redireccionar a menu_adm.php
    header("Location: menu_adm.php");
    exit;
}

// Procesar formulario para agregar materia si se recibe una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nombre"]) && isset($_POST["descripcion"])) {
    // Obtener los datos del formulario
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $carrera_id = $_POST["carrera_id"]; // Asegúrate de tener este valor
    
    // Llamar a la función para agregar la materia
    agregarMateria($nombre, $descripcion, $carrera_id);
}

// Función para obtener todas las materias de la base de datos
function obtenerMaterias() {
    include("config.php");
    $connection = conexion();
    
    // Consulta SQL para seleccionar todas las materias
    $query = "SELECT id, nombre, descripcion, carrera_id FROM materias";
    
    // Ejecutar la consulta
    $resultado = mysqli_query($connection, $query);
    
    // Verificar si se encontraron materias
    if (mysqli_num_rows($resultado) > 0) {
        // Array para almacenar todas las materias
        $materias = array();
        
        // Recorrer los resultados y guardar cada materia en el array
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $materias[] = $fila;
        }
        
        // Cerrar la conexión
        mysqli_close($connection);
        
        // Devolver el array de materias
        return $materias;
    } else {
        // Si no se encontraron materias, devolver null
        mysqli_close($connection);
        return null;
    }
}

// Agrega una nueva carrera a la base de datos
function agregarCarrera($nombreCarrera, $precioCarrera) {
    include("config.php");
    $connection = conexion();
    
    // Escapar caracteres especiales para evitar inyección SQL
    $nombreCarrera = mysqli_real_escape_string($connection, $nombreCarrera);
    $precioCarrera = mysqli_real_escape_string($connection, $precioCarrera);
    
    // Verificar si la carrera ya existe
    $query_check = "SELECT COUNT(*) AS count FROM carreras WHERE nombre = '$nombreCarrera'";
    $result_check = mysqli_query($connection, $query_check);
    $row_check = mysqli_fetch_assoc($result_check);
    
    if ($row_check['count'] > 0) {
        $_SESSION['mensaje'] = "Ya existe una carrera con el mismo nombre.";
    } else {
        // Preparar la consulta SQL para insertar la nueva carrera
        $query_insert = "INSERT INTO carreras (nombre, costo) VALUES ('$nombreCarrera', '$precioCarrera')";
        
        // Ejecutar la consulta de inserción
        if(mysqli_query($connection, $query_insert)) {
            $_SESSION['mensaje'] = "Carrera agregada correctamente.";
        } else {
            $_SESSION['mensaje'] = "Error al agregar la carrera: " . mysqli_error($connection);
        }
    }
    
    // Cerrar la conexión
    mysqli_close($connection);
    
    // Redireccionar a menu_adm.php
    header("Location: menu_adm.php");
    exit;
}

// Procesar formulario para agregar carrera si se recibe una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nombre-carrera"]) && isset($_POST["precio-carrera"])) {
    // Obtener los datos del formulario
    $nombreCarrera = $_POST["nombre-carrera"];
    $precioCarrera = $_POST["precio-carrera"];
    
    // Llamar a la función para agregar la carrera
    agregarCarrera($nombreCarrera, $precioCarrera);
}