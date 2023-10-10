<?php
session_start();

require_once 'db_config.php';

// Ejemplo de consulta a la base de datos
$query = "SELECT * FROM alumnos"; // Cambia 'alumnos' por el nombre de la tabla que deseas consultar
$resultado = $conexion->query($query);

// Procesar el resultado de la consulta
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        // Aquí puedes acceder a los datos de cada fila usando $fila['nombre_columna']
        echo "ID: " . $fila['ID_Alumno'] . " - Nombre: " . $fila['Nombre'] . "<br>";
    }
} else {
    echo "No se encontraron resultados.";
}

// Cerrar la conexión
$conexion->close();
?>