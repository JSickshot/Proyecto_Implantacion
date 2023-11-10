<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$nombreUsuario = $_SESSION['usuario']['nombre'];
$rol = $_SESSION['usuario']['rol'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Página Principal</title>
</head>
<body>
    <h2>Bienvenido, <?php echo $nombreUsuario; ?>!</h2>

    <?php
    if ($rol == 'profesor') {
        echo "<p>Opciones para profesores:</p>";
        echo "<ul>";
        echo "<li>Modificar materias</li>";
        echo "<li>Administrar horarios</li>";
        echo "<li>...</li>";
        echo "</ul>";
    } elseif ($rol == 'alumno') {
        echo "<p>Opciones para alumnos:</p>";
        echo "<ul>";
        echo "<li>Visualizar materias</li>";
        echo "<li>Entregar tareas</li>";
        echo "<li>Ver horarios</li>";
        echo "<li>...</li>";
        echo "</ul>";
    } else {
        echo "<p>Acceso no autorizado</p>";
    }
    ?>

    <a href="../preregistro/cerrar-sesion.php">Cerrar sesión</a>
</body>
</html>
