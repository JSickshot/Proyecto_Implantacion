


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
        <a href="P_calificaciones.php"><button>Calificaciones</button></a>
        <a href="../PreRegistro/cerrar-sesion.php"><button>Cerrar sesión</button></a>
    </div>
    <br><br>



</body>

<?php
include_once "../Conexion/db_config.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


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
                $idCursoInsertado = $stmtInsertarCurso->insert_id;

                $sqlInsertarHorario = "INSERT INTO horariop (id_usuario, id_curso, materia, horario, salon) VALUES (?, ?, ?, ?, ?)";
                $stmtInsertarHorario = $conexion->prepare($sqlInsertarHorario);

                if ($stmtInsertarHorario) {
                    $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];
                    $horas = ['8:00-10:00', '10:00-12:00', '12:00-14:00', '14:00-16:00', '16:00-18:00'];

                    $idUsuario = $_SESSION['usuario']['id'];
                    $materia = "NombreMateria";  
                    $diaAleatorio = $dias[array_rand($dias)];
                    $horaAleatoria = $horas[array_rand($horas)];
                    $grupoAleatorio = generateRandomString(6);  

                    $stmtInsertarHorario->bind_param("iisss", $idUsuario, $idCursoInsertado, $materia, "$diaAleatorio $horaAleatoria", $grupoAleatorio);
                    $stmtInsertarHorario->execute();

                    if ($stmtInsertarHorario->affected_rows > 0) {
                        echo '<script>alert("Curso y horario agregados exitosamente.");</script>';
                    } else {
                        echo '<script>alert("Error al agregar el horario.");</script>';
                    }

                    $stmtInsertarHorario->close();
                } else {
                    echo "Error en la preparación de la consulta: " . $conexion->error;
                }

            } else {
                echo '<script>alert("Error al agregar el curso.");</script>';
            }

            $stmtInsertarCurso->close();
        } else {
            echo "Error en la preparación de la consulta: " . $conexion->error;
        }
    }
}

function generateRandomString($length = 6) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}

$conexion->close();
?>
<h1>Página en Mantenimiento</h1>
    <p>Perdón por las demoras. Estamos trabajando para mejorar nuestro sitio y volveremos pronto.</p>