<?php
$host = "localhost";
$usuario = "user";
$contrasena = "123";
$nombreBaseDatos = "sistemacontrolescolar";

// Conexión a la base de datos
$conexion = new mysqli($host, $usuario, $contrasena, $nombreBaseDatos);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Procesar la búsqueda si se envió el formulario
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