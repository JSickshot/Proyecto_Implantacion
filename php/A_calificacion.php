<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Proyecto_implantacion/css/A_calificacion.css">
    <title>Alumno</title>
    
</head>

<body>
    <div class="Azul-fondo"></div>
    <div class="container">
        <a href="A_principal.php"><button>Principal</button></a>
        <a href="A_horario.php"><button>Horario</button></a>
        <a href="A_calificacion.php"><button>Calificaciones/Asistencias</button></a>
        <a href="../php/cerrar-sesion.php"><button>Cerrar sesión</button></a>
    </div>

    <?php
    session_start();
    include_once "../Conexion/db_config.php";

    if (!isset($_SESSION['usuario'])) {
        header("Location: ../logeos/login.php");
        exit();
    }

    $idUsuario = $_SESSION['usuario']['id'];
    $conexion = obtenerConexion();

    if (!$conexion) {
        die("Conexión a la base de datos fallida.");
    }

    $sqlConsultarHorarios = "SELECT id, materia, horario FROM horarios WHERE id_usuario = ?";
    $stmtConsultarHorarios = $conexion->prepare($sqlConsultarHorarios);

    if ($stmtConsultarHorarios) {
        $stmtConsultarHorarios->bind_param("i", $idUsuario);
        $stmtConsultarHorarios->execute();
        $resultHorarios = $stmtConsultarHorarios->get_result();

        if ($resultHorarios->num_rows > 0) {
            echo "<h2>Materias y Calificaciones:</h2>";
            echo "<ul class='lista-materias printable-content'>";

            while ($row = $resultHorarios->fetch_assoc()) {
                $sqlConsultarCalificaciones = "SELECT calificacion FROM calificaciones WHERE id_horario = ?";
                $stmtConsultarCalificaciones = $conexion->prepare($sqlConsultarCalificaciones);

                if ($stmtConsultarCalificaciones) {
                    $stmtConsultarCalificaciones->bind_param("i", $row['id']);
                    $stmtConsultarCalificaciones->execute();
                    $resultCalificaciones = $stmtConsultarCalificaciones->get_result();

                    if ($resultCalificaciones->num_rows > 0) {
                        $calificacionRow = $resultCalificaciones->fetch_assoc();
                        $calificacion = $calificacionRow['calificacion'];
                    } else {
                        $calificacion = mt_rand(6, 10);

                        $sqlInsertarCalificacion = "INSERT INTO calificaciones (id_horario, calificacion) VALUES (?, ?)";
                        $stmtInsertarCalificacion = $conexion->prepare($sqlInsertarCalificacion);

                        if ($stmtInsertarCalificacion) {
                            $stmtInsertarCalificacion->bind_param("ii", $row['id'], $calificacion);
                            $stmtInsertarCalificacion->execute();
                            $stmtInsertarCalificacion->close();
                        } else {
                            echo "Error en la preparación de la consulta de inserción de calificación.";
                        }
                    }

                    $stmtConsultarCalificaciones->close();
                } else {
                    echo "Error en la preparación de la consulta de calificaciones.";
                }

                echo "<li class='materia-calificacion'>";
                echo "<span class='materia'>Materia: {$row['materia']}</span>";
                echo "<span class='calificacion'>Calificación: $calificacion</span>";
                echo "</li>";
            }

            echo "</ul>";

            echo "<button onclick='imprimirHistorial()'>Imprimir Calificación</button>";
        } else {
            echo "<p>No hay materias y horarios asignados para este usuario.</p>";
        }

        $stmtConsultarHorarios->close();
    } else {
        echo "Error en la preparación de la consulta de horarios.";
    }

    $conexion->close();
    ?>

    <script>
        function imprimirHistorial() {
            window.print();
        }
    </script>
</body>

</html>
