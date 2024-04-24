<?php           
include_once("../inc/header.php");
include("../inc/sesiones.php");
include("../inc/consultas.php");
validarSesion();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal de administrativos</title>
    <link rel="stylesheet" href="menu_adm.css">
</head>
<body>
<div class="container">
    <div class="left-section">
        <div class="content">
            <div class="content-details">
                <?php
                encabezado();
                echo "Administrativo";
                ?>
            </div>
            <div class="profile-image-container">
                <img class="profile-image" src="../img/user.webp" alt="Silueta de usuario">
            </div>
        </div>
    </div>
</div>
<div class="enmedio">
    <div class="enmedio-texto">
        <p>¡Hola, <?php echo htmlspecialchars($_SESSION["nombreUsuario"]); ?>! Has iniciado sesión exitosamente en el sistema escolar. ¡Bienvenido de vuelta!</p>
    </div>
</div>
<div class="top-section">
    <div class="header">
        <div class="portal-caja">
            <h1>Portal de administrativos</h1>
        </div>
        <nav>
            <?php menu_adm(); ?>
        </nav>
    </div>
</div>

<!-- Agregamos el formulario para agregar materias -->
<div class="agregar-materia-form" style="display: none;" id="agregar-materia-form">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <label for="nombre">Nombre de la materia:</label><br>
        <input type="text" id="nombre" name="nombre"><br>
        <label for="descripcion">Descripción:</label><br>
        <textarea id="descripcion" name="descripcion"></textarea><br>
        <label for="carrera">Carrera:</label><br>
        <select id="carrera" name="carrera_id"> <!-- Cambiado a "carrera_id" para coincidir con el campo de la base de datos -->
            <?php 
            $resultado = obtenerTodasCarreras(); // Obtenemos todas las carreras
            while ($fila = mysqli_fetch_assoc($resultado)) { // Recorremos los resultados
                echo "<option value='" . $fila['id'] . "'>" . $fila['nombre'] . "</option>"; // Creamos la opción para cada carrera
            }
            ?>
        </select><br>
        <input type="submit" value="Agregar materia">
    </form>
</div>
<?php
// Leer el mensaje de la variable de sesión y luego borrarla para que no se muestre en futuras visitas a la página
if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    unset($_SESSION['mensaje']);
    // Mostrar el mensaje donde desees en tu HTML
    echo "<p>$mensaje</p>";
}
?>

<!-- Agregamos formulario para ver materias -->
<div class="ver-materias-form" style="display: none;">
    <table class="materias-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Carrera</th> <!-- Cambiado de "Carrera ID" a "Carrera" -->
            </tr>
        </thead>
        <tbody>
            <?php 
            $materias = obtenerMateriasConCarrera(); // Obtener todas las materias con el nombre de la carrera
            if ($materias) { // Verificar si se encontraron materias
                foreach ($materias as $materia) { // Recorrer las materias
                    echo "<tr>";
                    echo "<td>{$materia['id']}</td>"; // Mostrar el ID de la materia
                    echo "<td>{$materia['nombre']}</td>"; // Mostrar el nombre de la materia
                    echo "<td>{$materia['descripcion']}</td>"; // Mostrar la descripción de la materia
                    echo "<td>{$materia['nombre_carrera']}</td>"; // Mostrar el nombre de la carrera
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No se encontraron materias.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>


<!-- Formulario para ver carreras en una tabla -->
<div class="ver-carreras-form" style="display: none;">
    <table class="carreras-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th> <!-- Agrega la columna para el precio -->
            </tr>
        </thead>
        <tbody>
            <?php 
            $resultado = obtenerTodasCarreras(); // Obtenemos todas las carreras
            while ($fila = mysqli_fetch_assoc($resultado)) { // Recorremos los resultados
                echo "<tr>";
                echo "<td>{$fila['id']}</td>"; // Mostramos el ID de la carrera
                echo "<td>{$fila['nombre']}</td>"; // Mostramos el nombre de la carrera
                echo "<td>{$fila['costo']}</td>"; // Mostramos el precio de la carrera
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>


<!-- Agregamos el formulario para agregar carreras -->
<div class="agregar-carrera-form" style="display: none;" id="agregar-carrera-form">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <label for="nombre-carrera">Nombre de la carrera:</label><br>
        <input type="text" id="nombre-carrera" name="nombre-carrera"><br>
        <label for="precio-carrera">Precio de la carrera:</label><br>
        <input type="number" id="precio-carrera" name="precio-carrera"><br>
        <input type="submit" value="Agregar carrera">
    </form>
</div>

<?php
// Mostrar mensaje si existe
if (isset($_SESSION['mensaje'])) {
    echo "<p>{$_SESSION['mensaje']}</p>";
    unset($_SESSION['mensaje']); // Limpiar el mensaje para futuras solicitudes
}
?>

<script>
// Función para mostrar u ocultar el formulario de agregar materias
function mostrarAgregarMateria() {
    // Obtener el elemento del formulario de agregar materias
    var agregarMateriaForm = document.querySelector('.agregar-materia-form');

    // Verificar el estado actual del formulario
    if (agregarMateriaForm.style.display === 'block') {
        // Si el formulario está visible, ocultarlo
        agregarMateriaForm.style.display = 'none';
    } else {
        // Si el formulario está oculto, mostrarlo
        // Ocultar los formularios de ver materias y ver carreras
        document.querySelector('.ver-materias-form').style.display = 'none';
        document.querySelector('.ver-carreras-form').style.display = 'none';
        ocultarAgregarCarrera(); // Ocultar el formulario de agregar carreras
        
        // Mostrar el formulario de agregar materias
        agregarMateriaForm.style.display = 'block';
    }
}

// Función para mostrar u ocultar el formulario de ver carreras
function mostrarVerCarreras() {
    // Obtener el formulario de ver carreras
    var verCarrerasForm = document.querySelector('.ver-carreras-form');

    // Verificar si está visible
    if (verCarrerasForm.style.display === 'block') {
        // Si está visible, ocultarlo
        verCarrerasForm.style.display = 'none';
    } else {
        // Si está oculto, mostrarlo y ocultar los otros formularios
        verCarrerasForm.style.display = 'block';
        ocultarVerMaterias();
        ocultarAgregarMateria();
        ocultarAgregarCarrera(); // Ocultar el formulario de agregar carreras
    }
}

// Función para mostrar u ocultar el formulario de ver materias
function mostrarVerMaterias() {
    // Obtener el formulario de ver materias
    var verMateriasForm = document.querySelector('.ver-materias-form');

    // Verificar el estado actual del formulario
    if (verMateriasForm.style.display === 'block') {
        // Si el formulario está visible, ocultarlo
        verMateriasForm.style.display = 'none';
    } else {
        // Si el formulario está oculto, mostrarlo
        // Ocultar los formularios de agregar materias y ver carreras
        document.querySelector('.agregar-materia-form').style.display = 'none';
        document.querySelector('.ver-carreras-form').style.display = 'none';
        ocultarAgregarCarrera(); // Ocultar el formulario de agregar carreras
        
        // Mostrar el formulario de ver materias
        verMateriasForm.style.display = 'block';
    }
}

// Función para ocultar el formulario de agregar materia
function ocultarAgregarMateria() {
    var agregarMateriaForm = document.querySelector('.agregar-materia-form');
    if (agregarMateriaForm.style.display === 'block') {
        agregarMateriaForm.style.display = 'none';
    }
}

// Función para ocultar el formulario de ver materias
function ocultarVerMaterias() {
    var verMateriasForm = document.querySelector('.ver-materias-form');
    if (verMateriasForm.style.display === 'block') {
        verMateriasForm.style.display = 'none';
    }
}

// Función para mostrar u ocultar el formulario de agregar carreras
function mostrarAgregarCarrera() {
    // Ocultar el formulario de ver materias si está visible
    ocultarVerMaterias();
    
    // Obtener el formulario de agregar carrera
    var agregarCarreraForm = document.querySelector('#agregar-carrera-form');

    // Verificar el estado actual del formulario
    if (agregarCarreraForm.style.display === 'block') {
        // Si el formulario está visible, ocultarlo
        agregarCarreraForm.style.display = 'none';
    } else {
        // Si el formulario está oculto, mostrarlo
        // Ocultar los formularios de agregar materias y ver carreras
        document.querySelector('.agregar-materia-form').style.display = 'none';
        document.querySelector('.ver-carreras-form').style.display = 'none';
        
        // Mostrar el formulario de agregar carrera
        agregarCarreraForm.style.display = 'block';
    }
}

// Función para ocultar el formulario de agregar carrera
function ocultarAgregarCarrera() {
    var agregarCarreraForm = document.querySelector('#agregar-carrera-form');
    if (agregarCarreraForm.style.display === 'block') {
        agregarCarreraForm.style.display = 'none';
    }
}
</script>
</body>
</html>