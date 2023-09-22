<?php
$host = "localhost"; // Cambia esto al host de tu base de datos
$usuario = "tu_nombre_de_usuario"; // Cambia esto al nombre de usuario de tu base de datos
$contrasena = "tu_contraseña"; // Cambia esto a la contraseña de tu base de datos
$nombreBaseDatos = "sistemacontrolescolar"; // Cambia esto al nombre de la base de datos

// Conexión a la base de datos
$conexion = new mysqli($host, $usuario, $contrasena, $nombreBaseDatos);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

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