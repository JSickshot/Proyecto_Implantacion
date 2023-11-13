<?php
session_start();

$conexion = new mysqli("localhost", "root", "", "pruebas");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if (isset($_POST['nombre'], $_POST['password'])) {
    $nombreONumeroCuenta = $_POST['nombre'];
    $password = $_POST['password'];

    $esProfesor = stripos($nombreONumeroCuenta, 'pro') !== false;

    $sql = "SELECT * FROM usuarios WHERE (nombre='$nombreONumeroCuenta' OR numero_cuenta='$nombreONumeroCuenta')";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();

        
        if (password_verify($password, $usuario['password'])) {
            $_SESSION['usuario'] = [
                'id' => $usuario['id'],
                'nombre' => $usuario['nombre'],
                'numero_cuenta' => $usuario['numero_cuenta'],
                'rol' => $esProfesor ? 'profesor' : 'alumno'
            ];

            header("Location: index.php");
            exit();
        } else{
            echo '<script>alert("Usuario o contraseña incorrectos.");</script>';
        }
    } else {
        echo "Usuario no encontrado";
    }
} else {
    echo "Nombre de usuario o contraseña no proporcionados.";
}

$conexion->close();
?>
