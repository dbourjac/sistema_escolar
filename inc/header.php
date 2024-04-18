<head>
    <link rel="stylesheet" type="text/css" href="css/header.css">
</head>
<?php
// Cambios
function encabezado() {
    echo "<h1>Bienvenudo</h1>";
    echo "<h2>{$_SESSION['nombreUsuario']}</h2>";
}
function menu() {
    echo "<nav>
            <ul>
                <a href='js/inscripcion.php'>Inscribirme</a>
                <a href='ofertaedu.php'>Oferta Educativa</a>
            </ul>
        </nav>";
}
function menu2() {
    echo "<nav class='secondary-menu'>
            <ul>
                <li>Materias</li>
                <li>Cursos</li>
                <li>Kardex</li>
                <li>Calificaciones</li>
                <li>Idiomas</li> 
                <li>Adeudos</li>
            </ul>
        </nav>";
}


?>
