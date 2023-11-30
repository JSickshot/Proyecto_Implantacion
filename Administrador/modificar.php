<?php
include_once "../Conexion/db_config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_usuario_modificar'])) {
    $idUsuario = intval($_POST['id_usuario_modificar']);
    $nuevoNombre = $_POST['nombre_modificar'];
    $nuevoApellidoP = $_POST['apellidoP_modificar'];

    $conexion = obtenerConexion();

    if ($conexion->connect_error) {
        die("Conexión a la base de datos fallida: " . $conexion->connect_error);
    }

    $sqlModificarUsuario = "UPDATE usuarios SET nombre = ?, ApellidoP = ? WHERE id = ?";
    $stmtModificarUsuario = $conexion->prepare($sqlModificarUsuario);

    try {
        if ($stmtModificarUsuario) {
            $stmtModificarUsuario->bind_param("ssi", $nuevoNombre, $nuevoApellidoP, $idUsuario);
            $stmtModificarUsuario->execute();

            if ($stmtModificarUsuario->affected_rows > 0) {
                echo json_encode(['success' => true, 'message' => 'Usuario modificado correctamente.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'No se encontró ningún usuario con el ID proporcionado para modificar.']);
            }

            $stmtModificarUsuario->close();
        } else {
            throw new Exception("Error en la preparación de la consulta: " . $conexion->error);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }

    $conexion->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Solicitud no válida.']);
}
?>
