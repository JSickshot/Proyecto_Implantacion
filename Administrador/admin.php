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

$sqlcursos = "SELECT * FROM cursos";
$resultcursos = $conexion->query($sqlcursos);

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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="../JavaScript/admin.js" defer></script>

    <title>Administrador</title>
</head>

<body>

    <h1>Panel de Administrador</h1>
    <a href="../PreRegistro/cerrar-sesion.php"><button>Cerrar sesión</button></a>

    <h2>Usuarios registrados en Control escolar:</h2>
    <table border='1'>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>pwd</th>
            <th>CALLE</th>
            <th>DELEGACION</th>
            <th>COLONIA</th>
            <th>TELEFONO</th>
            <th>FECHA_NAC</th>
            <th>Licenciatura</th>
            <th>numero_cuenta</th>
            <th>rol</th>
            <th>ruta_imagen</th>
            <th>estado</th>
            
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
                <td><?= $row['CALLE'] ?></td>
                <td><?= $row['DELEGACION'] ?></td>
                <td><?= $row['COLONIA'] ?></td>
                <td><?= $row['TELEFONO'] ?></td>
                <td><?= $row['FECHA_NAC'] ?></td>
                <td><?= $row['Licenciatura'] ?></td>
                <td><?= $row['numero_cuenta'] ?></td>
                <td><?= $row['rol'] ?></td>
                <td><?= $row['ruta_imagen'] ?></td>
                <td><?= $row['estado'] ?></td>
                
                <td><button class="eliminar" data-id="<?= $row['id'] ?>" onclick="eliminarUsuario(<?= $row['id'] ?>)">Eliminar</button></td>
                <td><button onclick="mostrarFormularioUsuario(<?= $row['id'] ?>)">Modificar</button></td>
                
            </tr>
        <?php endwhile;

        $resultUsuarios->close();
        ?>
    </table>

    <div id="formulario-modificacion-usuario" style="display: none;">
        <h3>Modificar Usuario</h3>
        <form id="formulario-usuario" onsubmit="return enviarFormularioUsuario()">
            <input type="hidden" id="id_usuario_modificar" name="id_usuario_modificar">
            Nombre: <input type="text" id="nombre_modificar" name="nombre_modificar"><br>
            Apellido Paterno: <input type="text" id="apellidoP_modificar" name="apellidoP_modificar"><br>

            <input type="submit" value="Guardar cambios">
        </form>
    </div>

    <h2>Materias con horario:</h2>
    <table border='1'>
        <tr>
            <th>Materia</th>
            <th>Horario</th>
            <th></th>
            <th></th>
        </tr>

        <?php while ($row = $resultHorarios->fetch_assoc()) : ?>
            <tr>
                <td><?= $row['materia'] ?></td>
                <td><?= $row['horario'] ?></td>
                <td><button class="eliminar" data-id="<?= $row['id'] ?>" onclick="eliminarUsuario(<?= $row['id'] ?>)">Eliminar</button></td>
                <td><button onclick="mostrarFormularioUsuario(<?= $row['id'] ?>)">Modificar</button></td>
            </tr>
        <?php endwhile;

        $resultHorarios->close();
        ?>

    </table>

    <h2>Cursos impartidos por:</h2>
    <table border='1'>
        <tr>
            <th>id</th>
            <th>Materia</th>
            <th>Descripción</th>
            <th>Horario</th>
            <th>Salón</th>
            <th></th>
            <th></th>
        </tr>

        <?php while ($row = $resultcursos->fetch_assoc()) : ?>
            <tr>
                <td><?= $row['id_curso'] ?></td>    
                <td><?= $row['nombre_curso'] ?></td>
                <td><?= $row['descripcion'] ?></td>
                <td><?= $row['horario'] ?></td>
                <td><?= $row['salon'] ?></td>

                <td><button class="eliminar" data-id="<?= $row['id_curso'] ?>" onclick="eliminarUsuario(<?= $row['id_curso'] ?>)">Eliminar</button></td>
                <td><button onclick="mostrarFormularioUsuario(<?= $row['id_curso'] ?>)">Modificar</button></td>
            </tr>
        <?php endwhile;

        $resultcursos->close();
        ?>

    </table>

    <?php
    $conexion->close();
    ?>

    <script>
        function enviarFormularioUsuario() {
            var idUsuario = document.getElementById('id_usuario_modificar').value;
            var nuevoNombre = document.getElementById('nombre_modificar').value;
            var nuevoApellidoP = document.getElementById('apellidoP_modificar').value;

            fetch('modificar.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id_usuario_modificar=' + idUsuario + '&nombre_modificar=' + encodeURIComponent(nuevoNombre) + '&apellidoP_modificar=' + encodeURIComponent(nuevoApellidoP),
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
            })
            .catch(error => {
                console.error('Error:', error);
            });

            return false;
        }

        function mostrarFormularioUsuario(id) {
            
            $('#id_usuario_modificar').val(id);
            $('#formulario-modificacion-usuario').show();
        }
    </script>

</body>

</html>
