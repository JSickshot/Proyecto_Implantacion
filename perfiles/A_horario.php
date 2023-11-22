<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Proyecto_implantacion/css/horario.css">
    <script src="../JavaScript/materias.js" defer></script>
    <title>Seleccionar Horario</title>
</head>

<body>

    <div class="Azul-fondo"></div>
    <div class="container">
        <a href="A_principal.php"><button>Principal</button></a>
        <a href="A_horario.php"><button>Horario</button></a>
        <a href="A_profesor.php"><button>Profesor</button></a>
        <a href="A_materias.php"><button>Materias/Carreras</button></a>
        <a href="A_calificacion.php"><button>Calificaciones/Asistencias</button></a>
        <a href="../PreRegistro/cerrar-sesion.php"><button>Cerrar sesión</button></a>
    </div>

    <h2>Seleccionar Horario</h2>

    <?php
    session_start();

    if (!isset($_SESSION['usuario'])) {
        header("Location: ../logeos/login.php");
        exit();
    }

    $conexion = obtenerConexion();

    if (!$conexion) {
        die("Conexión a la base de datos fallida.");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['materias'], $_POST['horarios'])) {
            $materias = $_POST['materias'];
            $horarios = $_POST['horarios'];

            $idUsuario = $_SESSION['usuario']['id'];

            if (count($materias) == 5 && count($horarios) == 5) {
                $sqlInsertarHorarios = "INSERT INTO horarios (id_usuario, materia, horario) VALUES (?, ?, ?)";
                $stmtInsertarHorarios = $conexion->prepare($sqlInsertarHorarios);

                if ($stmtInsertarHorarios) {
                    for ($i = 0; $i < 5; $i++) {
                        $stmtInsertarHorarios->bind_param("iss", $idUsuario, $materias[$i], $horarios[$i]);
                        $stmtInsertarHorarios->execute();

                        if ($stmtInsertarHorarios->affected_rows <= 0) {
                            echo "Error al guardar los horarios.";
                            break;
                        }
                    }

                    echo "Horarios guardados exitosamente.";
                    $stmtInsertarHorarios->close();
                } else {
                    echo "Error en la preparación de la consulta.";
                }
            } else {
                echo "Por favor, ingrese 5 materias y 5 horarios.";
            }
        }
    }

    $idUsuario = $_SESSION['usuario']['id'];
    $sqlConsultarHorarios = "SELECT materia, horario FROM horarios WHERE id_usuario = ?";
    $stmtConsultarHorarios = $conexion->prepare($sqlConsultarHorarios);

    if ($stmtConsultarHorarios) {
        $stmtConsultarHorarios->bind_param("i", $idUsuario);
        $stmtConsultarHorarios->execute();
        $result = $stmtConsultarHorarios->get_result();

        if ($result->num_rows > 0) {
            echo "<h2>Horario:</h2>";
            echo "<ul>";
            while ($row = $result->fetch_assoc()) {
                echo "<li>Materia: {$row['materia']}, Horario: {$row['horario']}</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No hay horarios almacenados.</p>";
        }

        $stmtConsultarHorarios->close();
    } else {
        echo "Error en la preparación de la consulta.";
    }

    function obtenerConexion()
    {
        $conexion = new mysqli("localhost", "root", "", "proyectoimplantacion");

        if ($conexion->connect_error) {
            return false;
        }

        return $conexion;
    }
    ?>

    <form action="procesar_seleccion_horario.php" method="post">
        <label for="materia">Seleccione su materia:</label>
        <select id="materia" name="materia" onchange="cargarHorarios()" required>
            <option value="" disabled selected>Seleccione una materia</option>
        </select><br><br>

        <label for="horario">Seleccione su horario:</label>
        <select id="horario" name="horario" required>
            <option value="" disabled selected>Seleccione un horario</option>
        </select><br><br>


        <input type="submit" class="guardar-btn" value="Guardar Horario"
            onclick="this.disabled=true;this.form.submit();">

    </form>
</body>

</html>