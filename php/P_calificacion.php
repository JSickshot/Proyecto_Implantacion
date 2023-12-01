<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Proyecto_implantacion/css/A_principal.css">
    <title>Profesor</title>
</head>

<body>
    <div class="Azul-fondo"></div>
    <div class="container">
        <a href="P_principal.php"><button>Principal</button></a>
        <a href="P_horario.php"><button>Horario</button></a>
        <a href="P_cursos.php"><button>Cursos</button></a>
        <a href="P_calificacion.php"><button>Calificaciones</button></a>
        <a href="../php/cerrar-sesion.php"><button>Cerrar sesión</button></a>
    </div>

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

    $sqlConsultarEstudiantes = "SELECT id, nombre, ApellidoP, APELLIDOM FROM usuarios WHERE rol = 'alumno'";
    $stmtConsultarEstudiantes = $conexion->prepare($sqlConsultarEstudiantes);
    $stmtConsultarEstudiantes->execute();
    $resultEstudiantes = $stmtConsultarEstudiantes->get_result();

    if ($resultEstudiantes->num_rows > 0) {
        echo "<h2>Asignar Calificaciones:</h2>";
        echo "<form action='asignar_calificacion.php' method='POST'>";
        echo "<label for='estudiante'>Seleccionar Estudiante:</label>";
        echo "<select name='estudiante' id='estudiante'>"; 
        
        while ($row = $resultEstudiantes->fetch_assoc()) {
            echo "<option value='{$row['id']}'>{$row['nombre']} {$row['ApellidoP']} {$row['APELLIDOM']}</option>";
        }

        echo "</select>";
        echo "<br><br><label for='calificacion'>Calificación  final :</label>";
        echo "<input type='number' name='calificacion' id='calificacion' min='0' max='10' required>";
        echo "<br><br><button type='submit'>Asignar Calificación</button>";
        echo "</form>";
    } else {
        echo "<p>No hay estudiantes registrados.</p>";
    }

    $stmtConsultarEstudiantes->close();
    $conexion->close();
    ?>
</body>

</html>
