<?php
include_once "../Conexion/db_config.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero_cuenta = $_POST["numero_cuenta"];
    $apellido_paterno = $_POST["apellido_paterno"];
    $apellido_materno = $_POST["apellido_materno"];
    $sql_select = "SELECT * FROM usuarios WHERE numero_cuenta='$numero_cuenta' AND ApellidoP='$apellido_paterno' AND APELLIDOM='$apellido_materno'";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        $sql_update = "UPDATE usuarios SET estado=1 WHERE numero_cuenta='$numero_cuenta' AND ApellidoP='$apellido_paterno' AND APELLIDOM='$apellido_materno'";
        
        if ($conn->query($sql_update) === TRUE) {
            header("Location: sigproc.php");
        } else {
            echo "No se pudo completar el proceso, intentelo de nuevo " . $conn->error;
        }
    } else {
        echo "Alumno no encontrado o datos incorrectos.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reinscripcion.css">
    <title>Formulario de Reinscripción</title>
</head>

<body>

    <h2 class="encabezado">Formulario de Reinscripción</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="numero_cuenta">Número de Cuenta:</label>
        <input type="text" name="numero_cuenta" required>
        <br>

        <label for="apellido_paterno">Apellido Paterno:</label>
        <input type="text" name="apellido_paterno" required>
        <br>

        <label for="apellido_materno">Apellido Materno:</label>
        <input type="text" name="apellido_materno" required>
        <br>

        <input type="submit" value="Procesar Solicitud"><br>
        <a href="#" class="boton-favor" onclick="history.go(-1); return false;"><button>Regresar a nuestro
                portal</button> </a>
                
    </div class="image-container">
        <img src="../image/buho.png" alt="Descripción de la imagen"
            style="width: 99px; height: auto; margin-left: 0; margin-right: 0;">

</div>

    </form>

</body>

</html>