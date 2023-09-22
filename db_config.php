<?php
$servername = "localhost";
$username = "user;
$password = "123";
$dbname = "sistemacontrolescolar";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
