<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/confirmacion.css">
    <title>Confirmación de Registro</title>
</head>
<body>
    <div class="container">
        <h1>Registro Exitoso</h1>
        <img src="../image/buho.png" alt="Búho">

        <?php
        if (isset($_GET['cuenta'])) {
            $numeroCuentaAsignado = $_GET['cuenta'];
            echo "<p>Tu número de cuenta asignado es: $numeroCuentaAsignado. ¡Recuerda anotarlo bien!</p>";
        } else {
            echo "<p>Error: No se proporcionó un número de cuenta.</p>";
        }
        ?>
        <p><a href="../php/login.php">Iniciar sesión</a></p>
    </div>
</body>
</html>
