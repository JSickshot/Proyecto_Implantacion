<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmación de Registro</title>
</head>
<body>
    <h2>Registro Exitoso</h2>

    <?php
    if (isset($_GET['cuenta'])) {
        $numeroCuentaAsignado = $_GET['cuenta'];
        echo "<p>Tu número de cuenta asignado es: $numeroCuentaAsignado recuerda anotarlo bien!!</p>";
    } else {
        echo "<p>Error: No se proporcionó un número de cuenta.</p>";
    }
    ?>

    <p><a href="iniciar-sesion.php">Iniciar sesión</a></p>
</body>
</html>
