<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/registro.css">
    <title>Registro</title>
</head>

<body>
    <div class="header">
        <h1>Registro</h1>
        <img src="../image/buho.png" alt="Descripción de la imagen" style="width: 99px; height: auto; margin-left: 0; margin-right: 0;">

        <a href="../index.html" style="color: white; text-decoration: none;">
            <h2>Regresar</h2>
        </a>
    </div>

    <form action="procesar_registro.php" method="post">
        <label for="nombre">Nombre(s):</label>
        <input type="text" name="nombre" id="nombre" required><br><br>

        <label for="ApellidoP">Apellido paterno:</label>
        <input type="text" name="ApellidoP"id="ApellidoP" required><br><br>

        <label for="ApellidoM">Apellido materno:</label>
        <input type="text" name="ApellidoM" id="ApellidoM" required><br><br>

        <label for="Calle">Calle:</label>
        <input type="text" name="Calle" id="Calle" required><br><br>

        <label for="Delegacion">Delegación:</label>
        <input type="text" name="Delegacion" id="Delegacion" required><br><br>

        <label for="Colonia">Colonia:</label>
        <input type="text" name="Colonia" id="Colonia" required><br><br>

        <label for="Telefono">Telefono/celular:</label>
        <input type="text" name="Telefono" id="Telefono" required><br><br>

        <label for="Fecha_nac">Fecha de nacimiento:</label>
        <input type="date" name="Fecha_nac" id="Fecha_nac" required><br><br>

        <label for="password">Crear contraseña:</label>
        <input type="password" name="password" id="password" required><br><br>

        <label for="licenciatura">Licenciatura a inscribir: </label>
        <select name="licenciatura" required >
            <option value="" disabled selected>Selecciona una licenciatura</option>
            <option value="Ing Sistemas Computacionales">Ing. Sistemas Computacionales</option>
            <option value="Lic Gastronomia">Lic. Gastronomia</option>
            <option value="Lic Psicologia">Lic. Psicologia</option>
            <option value="Ing Mecatronica">Ing. Mecatronica</option>
            <option value="Lic Actuaria">Lic. Actuaria</option>
            <option value="Lic Progamación orientada">Lic. Progamación orientada</option>
            <option value="Lic Administración de empresas">Lic. Administración de empresas</option>
            <option value="Lic Contabilidad">Lic. Contabilidad</option>
            <option value="Lic Derecho">Lic. Derecho</option>
            <option value="Lic Lenguas Extrangeras">Lic. Lenguas Extrangeras</option>
        </select><br> <br>        

        <input type="submit" value="Registrar">
    </form>
</body>

</html>