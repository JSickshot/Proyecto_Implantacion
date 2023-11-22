<?php
session_start();

$conexion = new mysqli("localhost", "root", "", "proyectoimplantacion");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if (isset($_POST['nombre'], $_POST['password'])) {
    $nombreONumeroCuenta = $_POST['nombre'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE (nombre='$nombreONumeroCuenta' OR numero_cuenta='$nombreONumeroCuenta')";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();

        if (password_verify($password, $usuario['password'])) {
            $rol = $usuario['rol'];

            $_SESSION['usuario'] = [
                'id' => $usuario['id'],
                'nombre' => $usuario['nombre'],
                'numero_cuenta' => $usuario['numero_cuenta'],
                'rol' => $rol
            ];

            if ($rol == 'profesor') {
                header("Location: ../perfiles/P_principal.php");
                exit();
            } elseif ($rol == 'alumno') {
                header("Location: ../perfiles/A_principal.php");
                exit();
            } elseif ($rol == 'admin') {  
                header("Location: ../Administrador/admin.php");
                exit();
            } else {
                echo '<script>alert("Error de credenciales"); window.history.back();</script>';
                exit();
            }
        } else {
            echo '<script>alert("Contraseña incorrecta"); window.history.back();</script>';
            exit();
        }
    } else {
        echo '<script>alert("Usuario no encontrado"); window.history.back();</script>';
        exit();
    }
} else {
    echo '<script>alert("Nombre de usuario o contraseña no proporcionados"); window.history.back();</script>';
    exit();
}

$conexion->close();
?>
