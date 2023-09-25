<?php
session_start();

require_once 'db_config.php';

if(isset($_GET['nombre'])) {
    $nombre = $_GET['nombre'];
    $query = "SELECT * FROM alumnos WHERE Nombre LIKE '%$nombre%'";
    $resultado = $conexion->query($query);

    // Mostrar los resultados
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            echo "ID: " . $fila['ID_Alumno'] . " - Nombre: " . $fila['Nombre'] . "<br>";
        }
    } else {
        echo "No se encontraron resultados.";
    }
}

// Cerrar la conexión
$conexion->close();
?>