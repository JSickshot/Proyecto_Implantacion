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
            $_SESSION['usuario'] = [
                'id' => $usuario['id'],
                'nombre' => $usuario['nombre'],
                'numero_cuenta' => $usuario['numero_cuenta'],
                'rol' => $usuario['rol']
            ];

            $rol = $usuario['rol'];

            if ($rol == 'profesor') {
                header("Location: ../Pagos/P_colegiaturas.php");
                exit();
            } elseif ($rol == 'alumno') {
                header("Location: ../Pagos/A_colegiaturas.php");
                exit();
            } else {
                echo '<script>alert("Error de credenciales");</script>';
            }
        } else {
            echo '<script>alert("Contraseña incorrecta");</script>';
        }
    } else {
        echo '<script>alert("Usuario no encontrado");</script>';
    }
} else {
    echo '<script>alert("Nombre de usuario o contraseña no proporcionados");</script>';
}

$conexion->close();
?>
