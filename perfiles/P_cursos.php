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

        $sqlInsertarCurso = "INSERT INTO cursos (id_profesor, nombre_curso, descripcion) VALUES (?, ?, ?)";
        $stmtInsertarCurso = $conexion->prepare($sqlInsertarCurso);

        if ($stmtInsertarCurso) {
            $stmtInsertarCurso->bind_param("iss", $idProfesor, $nombreCurso, $descripcion);
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

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Proyecto_implantacion/css/P_principal.css">
    <title>Profesor</title>
</head>

<body>
    <div class="Azul-fondo"></div>
    <div class="container">
        <a href="P_principal.php"><button>Principal</button></a>
        <a href="P_horario.php"><button>Horario</button></a>
        <a href="P_cursos.php"><button>Cursos</button></a>
        <a href="P_calificacion.php"><button>Calificaciones</button></a>
        <a href="../PreRegistro/cerrar-sesion.php"><button>Cerrar sesión</button></a>
    </div>
    <br><br><br>

    <?php
    $idProfesor = $_SESSION['usuario']['id'];
    $sqlConsultarCursos = "SELECT id_curso, nombre_curso, descripcion FROM cursos WHERE id_profesor = ?";
    $stmtConsultarCursos = $conexion->prepare($sqlConsultarCursos);

    if ($stmtConsultarCursos) {
        $stmtConsultarCursos->bind_param("i", $idProfesor);
        $stmtConsultarCursos->execute();
        $resultCursos = $stmtConsultarCursos->get_result();

        if ($resultCursos->num_rows > 0) {
            echo "<h2>Cursos:</h2>";
            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>Nombre del Curso</th><th>Descripción</th></tr>";
            while ($rowCurso = $resultCursos->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$rowCurso['id_curso']}</td>";
                echo "<td>{$rowCurso['nombre_curso']}</td>";
                echo "<td>{$rowCurso['descripcion']}</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No tienes cursos registrados.</p>";
        }

        $stmtConsultarCursos->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conexion->error;
    }
    ?>

    <form action="procesar_curso.php" method="post">
        <label for="nombre_curso">Nombre del Curso:</label>
        <input type="text" id="nombre_curso" name="nombre_curso" required><br><br>

        <label for="descripcion">Descripción del Curso:</label>
        <textarea id="descripcion" name="descripcion" required></textarea><br><br>

        <input type="submit" value="Agregar Curso">
    </form>

</body>
</html>
