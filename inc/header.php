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
                <li><a href='logout.php'>Cerrar Sesión</a></li>
            </ul>
        </nav>";
}
function menu_aca(){
    echo "<nav class='secondary-menu'>
    <ul>
        <li>Materias</li>
        <li>Cursos</li>
        <li>Kardex</li>
        <li>Calificaciones</li>
        <li>Idiomas</li> 
        <li>Adeudos</li>
        <li><a href='../logout.php'>Cerrar Sesión</a></li>
    </ul>
</nav>";
}
function menu_adm(){
    echo "<nav class='secondary-menu'>
    <ul>
        <li class='ver-materias'><a href='#' onclick='mostrarVerMaterias()'>Materias</a></li>
        <li class='agregar-materia'><a href='#' onclick='mostrarAgregarMateria()'>Agregar Materias</a></li>
        <li class='ver-carreras'><a href='#' onclick='mostrarVerCarreras()'>Carreras</a></li>
        <li class='agregar-carreras'><a href='#' onclick='mostrarAgregarCarrera()'>Agregar Carreras</a></li>
        <li><a href='../logout.php'>Cerrar Sesión</a></li>
    </ul>
</nav>";
}



?>