<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../Aplicacion/login.php");
    exit();
}

$conexion = new mysqli("localhost", "root", "", "proyectoimplantacion");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$idUsuario = $_SESSION['usuario']['id'];

$sql = "SELECT ruta_imagen FROM usuarios WHERE id = $idUsuario";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    $rutaImagen = $fila['ruta_imagen'];

    header("Content-Type: image/jpeg");
    readfile($rutaImagen);
} else {
    echo "No se encontraron datos del usuario.";
}

$conexion->close();
?>
