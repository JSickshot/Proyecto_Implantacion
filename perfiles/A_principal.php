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

$sql = "SELECT * FROM usuarios WHERE id = $idUsuario";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();

    $_SESSION['usuario'] = $fila;

    $nombreCompleto = $fila['nombre'] . ' ' . $fila['ApellidoP'] . ' ' . $fila['APELLIDOM'];

    $numeroCuenta = $fila['numero_cuenta'];
    $licenciatura = isset($_SESSION['usuario']['licenciatura']) ? $_SESSION['usuario']['licenciatura'] : 'Sin seleccionar';

} else {
    echo "No se encontraron datos del usuario.";
}


$conexion->close();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/pers_enca.css">
    <link rel="stylesheet" type="text/css" href="../css/pers_alum.css">
    <title>Alumno</title>
</head>

<body>
    <div class="Azul-fondo"></div>
    <div class="container">
        <a href="A_principal.html"><button>Principal</button></a>
        <a href="A_alumno.html"><button>Alumno</button></a>
        <a href="A_profesor.html"><button>Profesor</button></a>
        <a href="A_materias.html"><button>Materias/Carreras</button></a>
        <a href="A_calificacion.html"><button>Calificaciones/Asistencias</button></a>
        <a href="../Aplicacion/login.php"><button>Cerrar sesión</a>
    </div>
    <br>
    <br>
    <br>
    <div class="info-alumno-container">
        <div class="info-alumno">
            <div class="info-item">
                <?php echo $numeroCuenta; ?>
            </div>
            <br>
            <div class="info-item">
                <?php echo $nombreCompleto; ?>
                <div class="info-item">Licenciatura: <?php echo $licenciatura; ?></div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>