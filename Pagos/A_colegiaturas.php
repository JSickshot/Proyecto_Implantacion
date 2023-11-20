<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$conexion = new mysqli("localhost", "root", "", "proyectoimplantacion");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$numero_cuenta = $_SESSION['usuario']['numero_cuenta'];
$sqlEstudianteId = "SELECT id FROM usuarios WHERE numero_cuenta = ?";
$stmtEstudianteId = $conexion->prepare($sqlEstudianteId);
$stmtEstudianteId->bind_param("s", $numero_cuenta);

if ($stmtEstudianteId->execute()) {
    $stmtEstudianteId->store_result();
    $stmtEstudianteId->bind_result($estudiante_id);
    $stmtEstudianteId->fetch();

    $sqlColegiaturas = "SELECT * FROM colegiaturas WHERE estudiante_id = ?";
    $stmtColegiaturas = $conexion->prepare($sqlColegiaturas);
    $stmtColegiaturas->bind_param("i", $estudiante_id);
    $stmtColegiaturas->execute();
    $resultColegiaturas = $stmtColegiaturas->get_result();
} else {
    echo "Error al obtener el ID del estudiante: " . $stmtEstudianteId->error;
}

$stmtEstudianteId->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['colegiatura_id'], $_POST['monto_pago'])) {
        $colegiatura_id = $_POST['colegiatura_id'];
        $monto_pago = $_POST['monto_pago'];

        $sqlValidarColegiatura = "SELECT estudiante_id FROM colegiaturas WHERE id = ?";
        $stmtValidarColegiatura = $conexion->prepare($sqlValidarColegiatura);
        $stmtValidarColegiatura->bind_param("i", $colegiatura_id);
        $stmtValidarColegiatura->execute();
        $stmtValidarColegiatura->store_result();

        if ($stmtValidarColegiatura->num_rows > 0) {
            $stmtValidarColegiatura->bind_result($colegiatura_estudiante_id);
            $stmtValidarColegiatura->fetch();

            if ($colegiatura_estudiante_id == $estudiante_id) {
                $sqlActualizarColegiatura = "UPDATE colegiaturas SET estado = 'Pagado' WHERE id = ?";
                $stmtActualizarColegiatura = $conexion->prepare($sqlActualizarColegiatura);
                $stmtActualizarColegiatura->bind_param("i", $colegiatura_id);
                $stmtActualizarColegiatura->execute();

            } else {
                echo "La colegiatura no pertenece al estudiante.";
            }
        } else {
            echo "Colegiatura no encontrada.";
        }

        $stmtValidarColegiatura->close();
        $stmtActualizarColegiatura->close();
    }
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/colegiaturas.css">

    <title>Colegiaturas</title>
</head>

<body>
    <h1>Colegiaturas</h1>

    <?php if ($resultColegiaturas->num_rows > 0) : ?>
        <table border="1">
            <tr>
                <th>Monto</th>
                <th>Fecha de Pago</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            <?php while ($row = $resultColegiaturas->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $row['monto']; ?></td>
                    <td><?php echo $row['fecha_pago']; ?></td>
                    <td><?php echo $row['estado']; ?></td>
                    <td>
                        <?php if ($row['estado'] != 'Pagado') : ?>
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <input type="hidden" name="colegiatura_id" value="<?php echo $row['id']; ?>">
                                <label for="monto_pago">Monto a Pagar:</label>
                                <input type="number" name="monto_pago" step="0.01" required>
                                <input type="submit" value="Realizar Pago">
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else : ?>
        <p>No hay colegiaturas registradas.</p>
    <?php endif; ?>

    <a href="../PreRegistro/cerrar-sesion.php">Cerrar sesión</a>
</body>

</html>
