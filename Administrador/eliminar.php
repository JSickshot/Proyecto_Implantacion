<?php
include_once "../Conexion/db_config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $idUsuario = $_POST['id'];
    
    $conexion = obtenerConexion();

    if ($conexion->connect_error) {
        die("Conexión a la base de datos fallida: " . $conexion->connect_error);
    }

    $sqlEliminarUsuario = "DELETE FROM usuarios WHERE id = ?";
    $stmtEliminarUsuario = $conexion->prepare($sqlEliminarUsuario);

    if ($stmtEliminarUsuario) {
        $stmtEliminarUsuario->bind_param("i", $idUsuario);
        $stmtEliminarUsuario->execute();

        if ($stmtEliminarUsuario->affected_rows > 0) {
            echo "Usuario eliminado exitosamente.";
        } else {
            echo "Error al eliminar el usuario: " . $stmtEliminarUsuario->error;
        }

        $stmtEliminarUsuario->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conexion->error;
    }

    $conexion->close();
} else {
    echo "Solicitud no válida.";
}
?>
