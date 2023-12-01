<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Proyecto_implantacion/css/P_horario.css">
    
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
    <br><br>

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

    $sqlUsuariosAleatorios = "SELECT id, nombre, ApellidoP, APELLIDOM FROM usuarios WHERE rol = 'alumno' ORDER BY RAND() LIMIT 7";
    $stmtUsuariosAleatorios = $conexion->prepare($sqlUsuariosAleatorios);
    $stmtUsuariosAleatorios->execute();
    $resultUsuariosAleatorios = $stmtUsuariosAleatorios->get_result();

    if ($resultUsuariosAleatorios->num_rows > 0) {
        echo "<h2>Alumnos:</h2>";
        echo "<ul>";

        while ($row = $resultUsuariosAleatorios->fetch_assoc()) {
            $salonAleatorio = 'F' . rand(100, 999);

            echo "<li class='usuario-salon'>";
            echo "<span class='usuario'>{$row['nombre']} {$row['ApellidoP']} {$row['APELLIDOM']}</span>";
            echo "<span class='salon'>Salón: $salonAleatorio</span>";
            echo "</li>";
        }

        echo "</ul>";
    } else {
        echo "<p>No hay usuarios alumnos registrados.</p>";
    }

    $stmtUsuariosAleatorios->close();
    $conexion->close();
    ?>
</body>

</html>
