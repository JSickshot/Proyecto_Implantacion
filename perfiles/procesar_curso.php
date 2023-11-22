<?php
include_once "../Conexion/db_config.php";

session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'profesor') {
    header("Location: ../logeos/login.php");
    exit();
}

$conexion = obtenerConexion();

if (!$conexion) {
    die("Conexión a la base de datos fallida.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nombre_curso'], $_POST['descripcion'])) {
        $nombreCurso = $_POST['nombre_curso'];
        $descripcion = $_POST['descripcion'];
        $idProfesor = $_SESSION['usuario']['id'];

        $horario = generarHorarioAleatorio();
        $salon = generarSalonAleatorio();

        $sqlInsertarCurso = "INSERT INTO cursos (id_profesor, nombre_curso, descripcion, horario, salon) VALUES (?, ?, ?, ?, ?)";
        $stmtInsertarCurso = $conexion->prepare($sqlInsertarCurso);

        if ($stmtInsertarCurso) {
            $stmtInsertarCurso->bind_param("issss", $idProfesor, $nombreCurso, $descripcion, $horario, $salon);
            $stmtInsertarCurso->execute();

            if ($stmtInsertarCurso->affected_rows > 0) {
                echo '<script>alert("Curso agregado exitosamente.");</script>';
            } else {
                echo '<script>alert("Error al agregar el curso.");</script>';
            }

            $stmtInsertarCurso->close();
        } else {
            echo "Error en la preparación de la consulta: " . $conexion->error;
        }
    }
}

function generarHorarioAleatorio() {
    
    $horariosPosibles = ["Lunes 10:00 AM - 12:00 PM", "Miércoles 2:00 PM - 4:00 PM", "Viernes 9:00 AM - 11:00 AM"];
    $indiceAleatorio = array_rand($horariosPosibles);
    return $horariosPosibles[$indiceAleatorio];
}

function generarSalonAleatorio() {
    
    $letras = range('A', 'Z');
    $numeros = range(0, 9);

    $letraAleatoria = $letras[array_rand($letras)];
    $numeroAleatorio = $numeros[array_rand($numeros)];

    return $letraAleatoria . $letraAleatoria . $letraAleatoria . $numeroAleatorio . $numeroAleatorio . $numeroAleatorio;
}

$conexion->close();
?>
