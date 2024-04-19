<?php
// Cambios
function encabezado() {
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
                <li><a href='logout.php'>Cerrar Sesión</a></li> <!-- Agrega el enlace para cerrar sesión -->
            </ul>
        </nav>";
}
?>
