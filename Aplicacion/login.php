<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/pers_login.css">
  <title>Iniciar sesión</title>
</head>

<body>
  <div class="container">
    <img class="image" src="buho.png" alt="Descripción de la imagen">
  </div>
  <div class="login-container">
    <?php
            if (isset($_GET["error"]) && $_GET["error"] === "1") {
                echo '<script>alert("Usuario o contraseña incorrectos.");</script>';
            }
            ?>
            <form action="login_process.php" method="post">
                <h1><label for="username">Correo</label><input type="text" name="username" required><br>
                <label for="password">Contraseña:</label>
                <input type="password" name="password" required><br>
                <input type="submit" value="Iniciar sesion">
            </form>
  </div>
  <script src="scrpt.js"></script>
</body>

</html>

