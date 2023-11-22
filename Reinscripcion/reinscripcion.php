<?php
include_once "../Conexion/db_config.php"; 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero_cuenta = $_POST["numero_cuenta"];
    $apellido_paterno = $_POST["apellido_paterno"];
    $apellido_materno = $_POST["apellido_materno"];

    $sql = "UPDATE usuarios SET nombre='$nombre', ApellidoP='$apellido_paterno', APELLIDOM='$apellido_materno' WHERE numero_cuenta='$numero_cuenta'";

    if ($conn->query($sql) === TRUE) {
        echo "Reinscripción exitosa";
    } else {
        echo "Error en la reinscripción: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Reinscripción</title>
</head>
<body>

<h2>Formulario de Reinscripción</h2>

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

    <input type="submit" value="Procesar Solicitud">
</form>

</body>
</html>
