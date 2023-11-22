<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/login.css">
    <title>Iniciar Sesión</title>
</head>

<body>
    <div class="header">
        <a href="../reinscripcion/reinscripcion.php" class="header-text">Reinscripción</a>
        <a href="../index.html" class="header-text">Regresar</a>
    </div>

    <div class="container">
        <div class="login-form">
            <h2>Bienvenido</h2>
            <form action="login_process.php" method="post">

                <label for="nombre">Usuario:</label>
                <input type="text" name="nombre" required><br>

                <label for="password">Contraseña:</label>
                <input type="password" name="password" required><br>

                <input type="submit" value="Iniciar Sesión">
            </form>

        </div>
        <img src="../image/buho.png" alt="Descripción de la imagen"
            style="width: 99px; height: auto; margin-left: 0; margin-right: 0;">

    </div>

</body>

</html>