<?php
include_once "../Conexion/db_config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $idUsuario = filter_var($_POST['id'], FILTER_VALIDATE_INT);

    if ($idUsuario !== false && $idUsuario > 0) {
        $conexion = obtenerConexion();

        if ($conexion->connect_error) {
            die("Conexión a la base de datos fallida: " . $conexion->connect_error);
        }

        $sqlEliminarUsuario = "DELETE FROM usuarios WHERE id = ?";
        $stmtEliminarUsuario = $conexion->prepare($sqlEliminarUsuario);

        try {
            if ($stmtEliminarUsuario) {
                $stmtEliminarUsuario->bind_param("i", $idUsuario);
                $stmtEliminarUsuario->execute();

                if ($stmtEliminarUsuario->affected_rows > 0) {
                    echo json_encode(['success' => true, 'message' => 'Usuario eliminado correctamente.']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'No se encontró ningún usuario con el ID proporcionado para eliminar.']);
                }

                $stmtEliminarUsuario->close();
            } else {
                throw new Exception("Error en la preparación de la consulta: " . $conexion->error);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }

        $conexion->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'ID de usuario no válido.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Solicitud no válida.']);
}
?>
