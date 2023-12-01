<?php
$conexion = new mysqli("localhost", "root", "", "Proyectoimplantacion");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$nombre = $_POST['nombre'];
$ApellidoP = $_POST['ApellidoP'];
$ApellidoM = $_POST['ApellidoM'];
$calle = $_POST['Calle'];
$Delegacion = $_POST['Delegacion'];
$Colonia = $_POST['Colonia'];
$telefono = $_POST['Telefono'];
$Fecha_nac = $_POST['Fecha_nac'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$licenciatura = isset($_POST['licenciatura']) && $_POST['licenciatura'] !== 'ninguna' ? $_POST['licenciatura'] : 'No seleccionada';
$rol = $_POST['rol'];
$numeroCuenta = ($rol == 'profesor') ? 'P' . rand(10000000, 99999999) : 'A' . rand(10000000, 99999999);

session_start();
$_SESSION['usuario']['licenciatura'] = $licenciatura;

$sql = "INSERT INTO usuarios (nombre, ApellidoP, APELLIDOM, CALLE, DELEGACION, COLONIA, TELEFONO, FECHA_NAC, password, licenciatura, numero_cuenta, rol) 
        VALUES ('$nombre', '$ApellidoP', '$ApellidoM', '$calle', '$Delegacion', '$Colonia', '$telefono', '$Fecha_nac', '$password', '$licenciatura','$numeroCuenta', '$rol')";

if ($conexion->query($sql) === TRUE) {
    header("Location: confirmacion.php?cuenta=$numeroCuenta");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conexion->error;
}

$conexion->close();
?>
