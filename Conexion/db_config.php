<?php
function obtenerConexion() {
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "proyectoimplantacion";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Error de conexión a la base de datos: " . $conn->connect_error);
    }

    return $conn;
}


$conn = obtenerConexion();
?>
