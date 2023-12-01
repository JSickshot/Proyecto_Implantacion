<?php
session_start();
include_once "../Conexion/db_config.php";

if (!isset($_SESSION['usuario'])) {
    header("Location: ../logeos/login.php");
    exit();
}

$idProfesor = $_SESSION['usuario']['id'];
$conexion = obtenerConexion();

if (!$conexion) {
    die("Conexión a la base de datos fallida.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idEstudiante = $_POST['estudiante'];
    $calificacion = $_POST['calificacion'];

    $sqlVerificarEstudiante = "SELECT 1 FROM usuarios WHERE id = ? AND rol = 'alumno'";
    $stmtVerificarEstudiante = $conexion->prepare($sqlVerificarEstudiante);
    $stmtVerificarEstudiante->bind_param("i", $idEstudiante);
    $stmtVerificarEstudiante->execute();
    $resultVerificarEstudiante = $stmtVerificarEstudiante->get_result();

    if ($resultVerificarEstudiante->num_rows > 0) {
        $sqlObtenerHorario = "SELECT id FROM horarios WHERE id_usuario = ?";
        $stmtObtenerHorario = $conexion->prepare($sqlObtenerHorario);
        $stmtObtenerHorario->bind_param("i", $idEstudiante);
        $stmtObtenerHorario->execute();
        $resultObtenerHorario = $stmtObtenerHorario->get_result();

        if ($resultObtenerHorario->num_rows > 0) {
            $rowObtenerHorario = $resultObtenerHorario->fetch_assoc();
            $idHorario = $rowObtenerHorario['id'];

            $sqlInsertarCalificacion = "INSERT INTO calificaciones (id_horario, calificacion) VALUES (?, ?)";
            $stmtInsertarCalificacion = $conexion->prepare($sqlInsertarCalificacion);
            $stmtInsertarCalificacion->bind_param("ii", $idHorario, $calificacion);

            if ($stmtInsertarCalificacion->execute()) {
                echo "<script>alert('Calificación asignada correctamente.'); window.location.href = window.location.href;</script>";
            } else {
                echo "Error al asignar la calificación.";
            }

            $stmtInsertarCalificacion->close();
        } else {
            echo "Error: No se encontró el horario del estudiante.";
        }

        $stmtObtenerHorario->close();
    } else {
        echo "Error: Estudiante no válido.";
    }

    $stmtVerificarEstudiante->close();
}

$conexion->close();
?>
