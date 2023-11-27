<?php
include_once "../Conexion/db_config.php"; 

session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    header("Location: ../logeos/login.php");
    exit();
}

$conexion = obtenerConexion();

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$sqlUsuarios = "SELECT * FROM usuarios";
$resultUsuarios = $conexion->query($sqlUsuarios);

$sqlHorarios = "SELECT * FROM horarios";
$resultHorarios = $conexion->query($sqlHorarios);

if (!$resultUsuarios || !$resultHorarios) {
    die("Error en las consultas SQL: " . $conexion->error);
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Proyecto_implantacion/css/admin.css">
    <script src="../JavaScript/admin.js" defer></script>

    <title>Administrador</title>
</head>

<body>

    <h1>Panel de Administrador</h1>
    <a href="../PreRegistro/cerrar-sesion.php"><button>Cerrar sesión</button></a>


    <h2>Usuarios registrados en __:</h2>
    <table border='1'>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>pwd</th>
            <th></th>
            <th></th>
            
        </tr>

        <?php while ($row = $resultUsuarios->fetch_assoc()) : ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['nombre'] ?></td>
                <td><?= $row['ApellidoP'] ?></td>
                <td><?= $row['APELLIDOM'] ?></td>
                <td><?= $row['password'] ?></td>
                
                <td><button class="eliminar" data-id="<?= $row['id'] ?>" onclick="eliminarUsuario(<?= $row['id'] ?>)">Eliminar</button></td>
                <td><button onclick="modificarUsuario(<?= $row['id'] ?>)">Modificar</button></td>
                
            </tr>
        <?php endwhile;

        $resultUsuarios->close();
        ?>
    </table>

    <h2>Horarios con éxito:</h2>
    <table border='1'>
        <tr>
            
            <th>Materia</th>
            <th>Horario</th>
        </tr>

        <?php while ($row = $resultHorarios->fetch_assoc()) : ?>
            <tr>
                <td><?= $row['materia'] ?></td>
                <td><?= $row['horario'] ?></td>
            </tr>
        <?php endwhile;

        $resultHorarios->close();
        ?>

    </table>

    <?php
    $conexion->close();
    ?>

</body>

</html>
