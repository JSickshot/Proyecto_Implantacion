<?php
$conexion = new mysqli("localhost", "root", "", "nombre_de_tu_base_de_datos");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$id_profesor = 7; 
$nombre_materia = $_POST['nombre_materia']; 
$grupo = $_POST['grupo']; 

$sql = "INSERT INTO materias (nombre, grupo, id_profesor) VALUES ('$nombre_materia', '$grupo', $id_profesor)";
Materia
        Grupo
        Lunes
        Marte
        Miercoles
        Jueves
        Viernes
        Sabado
        Salón


if ($conexion->query($sql) === TRUE) {
    echo "Materia registrada exitosamente.";
} else {
    echo "Error al registrar la materia: " . $conexion->error;
}

$conexion->close();
?>
