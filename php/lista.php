<?php
include('conexion.php');

$consulta = "SELECT * FROM materias";
$resultado = $conexion->query($consulta);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listar Materias</title>
</head>
<body>

<h2>Listado de Materias</h2>

<ul>
    <?php
    while ($fila = $resultado->fetch_assoc()) {
        echo "<li>{$fila['nombre']} - Código: {$fila['codigo']} - Créditos: {$fila['creditos']}</li>";
    }
    ?>
</ul>

</body>
</html>
