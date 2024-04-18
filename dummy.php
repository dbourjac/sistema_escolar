<link rel="stylesheet" href="css/dummy.css">

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<a href="registro.php" class="back-button">Volver</a>
  <label for="tipo">Seleccione el tipo de datos:</label>
  <select id="tipo" name="tipo">
    <option value="alumnos">Alumnos</option>
    <option value="academicos">Académicos</option>
    <option value="administrativos">Administrativos</option>
  </select>
  <br><br>
  <label for="cantidad">Cantidad de registros:</label>
  <input type="number" id="cantidad" name="cantidad" min="1" max="100" value="10">
  <br><br>
  <input type="submit" name="submit" value="Generar">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo = $_POST['tipo'];
    $cantidad = $_POST['cantidad'];
    
    // Generar Nombre
    function generateRandomName() {
        $names = array(
            "Pedro", "María", "Juan", "Sofía", "Diego", "Laura", "Ana", "Carlos", "Luis", "Elena", 
            "Gabriela", "Jorge", "Paola", "Fernando", "Valeria", "Ricardo", "Natalia", "Alejandro", "Adriana", "Roberto", 
            "Isabela", "Miguel", "Verónica", "Daniel", "Camila", "José", "Andrea", "Fabián", "Karla", "Arturo", 
            "Fernanda", "Francisco", "Lucía", "Rosa", "Javier", "Patricia", "Rafael", "Esther", "Hugo", "Carmen", 
            "Ignacio", "Lorena", "Ramón", "Vanessa", "Héctor", "Diana", "Óscar", "Victoria", "Raúl", "Julia", 
            "Armando", "Paulina", "Manuel", "Daniela", "Silvia", "Mario", "Gloria", "Mónica", 
            "Guillermo", "Eva", "Lorenzo", "Nancy", "César", "Luisa", "Salvador", "Teresa", "Víctor", 
            "Cecilia", "Antonio", "Norma", "Ángel", "Félix", "David", "Cristina", "Enrique", 
            "Claudia", "Rodrigo", "Martha", "Marco", "Jaime", "Carolina", "Maribel", "Martín", 
            "Rebeca", "Jesús", "Beatriz", "Mauricio", "Jessica", "Alfredo", "Alma"
        );
        $randomName = $names[array_rand($names)];
        return $randomName;
    }
    
    // Generar Apellido
    function generateRandomLastName() {
        $lastNames = array(
            "Rodríguez", "Pérez", "García", "Martínez", "López", "Sánchez", "Gómez", "Fernández", "Díaz", "Hernández", 
            "González", "Álvarez", "Torres", "Ruiz", "Flores", "Romero", "Gutiérrez", "Vázquez", "Ramos", "Jiménez", 
            "Mendoza", "Castillo", "Ortiz", "Moreno", "Silva", "Cruz", "Chávez", "León", "Medina", 
            "Ramírez", "Vargas", "Reyes", "Guzmán", "Sosa", "Aguilar", "Molina", "Navarro", "Arias", "Suárez", 
            "Peña", "Miranda", "Juárez", "Salazar", "Cortés", "Valdez", "Dominguez", 
            "Cervantes", "Peralta", "Valencia", "Corona", "Acosta", "Rangel", "Téllez", "Herrera", "Fuentes", "Franco", 
            "Barajas", "Ríos", "Duarte", "Guerrero", "Maldonado", "Méndez", "Márquez", "Barrios", 
            "Zavala", "Chavarría", "Carvajal", "Becerra", "Esquivel", "Ochoa", "Escobedo", "Luna", "Montes", "Ibarra", 
            "Cabrera", "Castañeda", "Bustamante", "Gálvez", "Calderón", "Rivera", "Leyva", "Solís", "Benítez", 
            "Ponce", "Quintero", "Mercado", "Alvarado", "Salinas", "Cárdenas", "Quiróz", "Delgado", "Treviño", "Castaño"
        );
        $randomLastName = $lastNames[array_rand($lastNames)];
        return $randomLastName;
    }
    
    // Fecha de Nacimiento
    function generateRandomDateOfBirth() {
        $start = strtotime("1900-01-01");
        $end = strtotime("2007-12-31");
        $randomTimestamp = mt_rand($start, $end);
        
        return date("Y-m-d", $randomTimestamp);
    }
    
    // Email
    function generateRandomEmail($expediente, $tipoUsuario) {
        $domain = "unison.mx";
        $prefix = '';
    
        switch ($tipoUsuario) {
            case 'alumnos':
                $prefix = 'a';
                break;
            case 'academicos':
                $prefix = 'b';
                break;
            case 'administrativos':
                $prefix = 'c';
                break;
            default:
                $prefix = 'a'; // Por defecto, asignar 'a' para alumnos
                break;
        }
        return $prefix . $expediente . '@' . $domain;
    }
    
    // Función para generar una CURP aleatoria
    function generateRandomCURP() {
        $letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $digits = "0123456789";
        
        $randomCURP = '';
        for ($i = 0; $i < 18; $i++) {
            if ($i < 4) {
                $randomCURP .= $letters[rand(0, strlen($letters) - 1)];
            } elseif ($i == 4) {
                $randomCURP .= rand(0, 9);
            } elseif ($i < 16) {
                $randomCURP .= $letters[rand(0, strlen($letters) - 1)];
            } elseif ($i == 16) {
                $randomCURP .= rand(0, 9);
            } else {
                $randomCURP .= $letters[rand(0, strlen($letters) - 1)];
            }
        }
        
        return $randomCURP;
    }
    
    // Contraseña
    function generateRandomPassword() {
        $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $password = substr(str_shuffle($characters), 0, 10);
        return ($password);
    }
    
    // Función para generar datos según el tipo seleccionado
    function generateData($tipo, $cantidad) {
        switch ($tipo) {
            case 'alumnos':
                echo "<div class='section-title'>-- Datos de alumnos --</div><br>";
                for ($i = 1; $i <= $cantidad; $i++) {
                    $expediente = rand(100000000, 999999999);
                    $nombre = generateRandomName();
                    $apellido_paterno = generateRandomLastName();
                    $apellido_materno = generateRandomLastName();    
                    $fecha_nac = generateRandomDateOfBirth();
                    $curp = generateRandomCURP();
                    $correo_inst = generateRandomEmail($expediente, 'alumnos');
                    $password = generateRandomPassword();
                    $carrera_elegida = rand(1, 147);
                    
                    echo "INSERT INTO alumnos (expediente, nombre, apellido_paterno, apellido_materno, fecha_nac, curp, correo_inst, password, carrera_elegida) VALUES ";
                    echo "($expediente, '$nombre', '$apellido_paterno', '$apellido_materno', '$fecha_nac', '$curp', '$correo_inst', '$password', $carrera_elegida);<br>";
                    echo "<br>";
                }
                break;
            case 'academicos':
                echo "<div class='section-title'>-- Datos de académicos --</div><br>";
                for ($i = 1; $i <= $cantidad; $i++) {
                    $expediente = rand(100000000, 999999999);
                    $nombre = generateRandomName();
                    $apellido_paterno = generateRandomName();
                    $apellido_materno = generateRandomName();
                    $fecha_nac = generateRandomDateOfBirth();
                    $curp = generateRandomCURP();
                    $correo_inst = generateRandomEmail($expediente, 'academicos');
                    $password = generateRandomPassword();
                    
                    echo "INSERT INTO academicos (expediente, nombre, apellido_paterno, apellido_materno, fecha_nac, curp, correo_inst, password) VALUES ";
                    echo "($expediente, '$nombre', '$apellido_paterno', '$apellido_materno', '$fecha_nac', '$curp', '$correo_inst', '$password');<br>";
                    echo "<br>";
                }
                break;
            case 'administrativos':
                echo "<div class='section-title'>-- Datos de administrativos --</div><br>";
                for ($i = 1; $i <= $cantidad; $i++) {
                    $expediente = rand(100000000, 999999999);
                    $nombre = generateRandomName();
                    $apellido_paterno = generateRandomName();
                    $apellido_materno = generateRandomName();
                    $fecha_nac = generateRandomDateOfBirth();
                    $curp = generateRandomCURP();
                    $correo_inst = generateRandomEmail($expediente, 'administrativos');
                    $password = generateRandomPassword();
                    
                    echo "INSERT INTO administrativos (expediente, nombre, apellido_paterno, apellido_materno, fecha_nac, curp, correo_inst, password) VALUES ";
                    echo "($expediente, '$nombre', '$apellido_paterno', '$apellido_materno', '$fecha_nac', '$curp', '$correo_inst', '$password');<br>";
                    echo "<br>";
                }
                break;
            default:
                echo "Tipo de datos no válido.";
                break;
        }
    }
    
    generateData($tipo, $cantidad);
}
?>
