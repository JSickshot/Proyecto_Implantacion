<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/registro.css">
    <title>Registro</title>
</head>

<body>
    <div> class="header">
        <h1>Registro</h1>
        <img src="../image/buho.png" alt="Descripción de la imagen" style="width: 99px; height: auto; margin-left: 0; margin-right: 0;">

        <a href="../index.html" style="color: white; text-decoration: none;">
            <h2>Regresar</h2>
        </a>
    </div>

    <form action="procesar_registro.php" method="post">
    <?php include('conexion.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reinscripción</title>
</head>
<body>

<h2>Proceso de reinscripción</h2>

<form action="procesar_reinscripcion.php" method="post">
    <label for="numero_cuenta">Número de Cuenta:</label>
    <input type="text" name="numero_cuenta" required><br>


    <input type="submit" value="Reinscribir">
</form>

</body>
</html>

        <input type="submit" value="Registrar">
    </form>
</body>

</html>