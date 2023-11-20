<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../Logeos/login.php");
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
    $licenciatura = isset($_SESSION['usuario']['Licenciatura']) ? $_SESSION['usuario']['Licenciatura'] : 'Sin seleccionar';

    $rutaImagen = $fila['ruta_imagen'];
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
    <link rel="stylesheet" href="/Proyecto_implantacion/css/A_principal.css">
    <title>Alumno</title>
</head>

<body>
    <div class="Azul-fondo"></div>
    <div class="container">
        <a href="A_principal.php"><button>Principal</button></a>
        <a href="A_alumno.php"><button>Alumno</button></a>
        <a href="A_profesor.php"><button>Profesor</button></a>
        <a href="A_materias.php"><button>Materias/Carreras</button></a>
        <a href="A_calificacion.php"><button>Calificaciones/Asistencias</button></a>
        <a href="../PreRegistro/cerrar-sesion.php"><button>Cerrar sesión</button></a>
    </div>
    <br>
    <br>
    <br>
    <div class="info-alumno-container">
        <div class="info-alumno">
            <div class="info-item-container">
                <div class="info-item">
                    Número de Cuenta:
                    <?php echo $numeroCuenta; ?>
                </div>
            </div>

            <div class="info-item-container">
                <div class="info-item">
                    Nombre Completo:
                    <?php echo $nombreCompleto; ?>
                </div>
            </div>

            <div class="info-item-container">
                <div class="info-item">
                    Licenciatura:
                    <?php echo $licenciatura; ?>
                </div>
            </div>
            <div class="info-item-container image-container">
                <div class="info-item">
                    <img src="mostrar_imagen.php" alt="Imagen de perfil" class="profile-image">
                    <form action="procesar_imagen.php" method="post" enctype="multipart/form-data">
                <label for="imagen">Subir imagen de perfil:</label>
                <input type="file" name="imagen" id="imagen" accept="image/*">
                <input type="submit" value="Subir imagen">
            </form>
                </div>
            </div>

            

        </div>
    </div>
</body>

</html>