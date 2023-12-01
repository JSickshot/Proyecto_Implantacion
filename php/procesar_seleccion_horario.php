<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../logeos/login.php");
    exit();
}

$conexion = obtenerConexion();

if (!$conexion) {
    die("Conexión a la base de datos fallida: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['materia'], $_POST['horario'])) {
        $materia = $_POST['materia'];
        $horario = $_POST['horario'];

        $idUsuario = $_SESSION['usuario']['id'];

        if ($idUsuario && $materia && $horario) {
            $sqlContarMaterias = "SELECT COUNT(*) as cantidad FROM horarios WHERE id_usuario = ?";
            $stmtContarMaterias = $conexion->prepare($sqlContarMaterias);

            if ($stmtContarMaterias) {
                $stmtContarMaterias->bind_param("i", $idUsuario);
                $stmtContarMaterias->execute();
                $stmtContarMaterias->bind_result($cantidadMaterias);
                $stmtContarMaterias->fetch();
                $stmtContarMaterias->close();

                if ($cantidadMaterias < 5) {
                    $sqlInsertarHorario = "INSERT INTO horarios (id_usuario, materia, horario) VALUES (?, ?, ?)";
                    $stmtInsertarHorario = $conexion->prepare($sqlInsertarHorario);

                    if ($stmtInsertarHorario) {
                        $stmtInsertarHorario->bind_param("iss", $idUsuario, $materia, $horario);
                        $stmtInsertarHorario->execute();

                        if ($stmtInsertarHorario->affected_rows > 0) {
                            echo '<script>alert("Horario guardado exitosamente.");</script>';
                            echo '<script>window.location.href = "A_horario.php";</script>';
                        } else {
                            die("Error al guardar el horario: " . $stmtInsertarHorario->error);
                        }

                        $stmtInsertarHorario->close();
                    } else {
                        die("Error en la preparación de la consulta: " . $conexion->error);
                    }
                } else {
                    echo '<script>alert("Ya has almacenado el máximo de 5 materias.");</script>';
                    echo '<script>window.location.href = "A_horario.php";</script>';
                }
            } else {
                die("Error en la preparación de la consulta: " . $conexion->error);
            }
        } else {
            echo "Por favor, complete todos los campos.";
        }
    }
}

$conexion->close();

function obtenerConexion() {
    $conexion = new mysqli("localhost", "root", "", "proyectoimplantacion");

    if ($conexion->connect_error) {
        return false;
    }

    return $conexion;
}
?>
