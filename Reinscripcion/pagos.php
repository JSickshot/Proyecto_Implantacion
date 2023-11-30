<?php
session_start();
include_once "../Conexion/db_config.php";

$cantidad_materias = isset($_SESSION['cantidad_materias']) ? $_SESSION['cantidad_materias'] : 0;
$costo_total = $cantidad_materias * 1000.00;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cantidad_ingresada = isset($_POST['cantidad_ingresada']) ? floatval($_POST['cantidad_ingresada']) : 0;

    if ($cantidad_ingresada >= $costo_total) {
        
        header("Location: confirmacion.php");
        exit();
    } else {
        $error_pago = "La cantidad ingresada no es suficiente.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/pagos.css">
    <title>Pago de Materias</title>
</head>
<body>

<h1>Pago de materias</h1>

<p>Cantidad de materias seleccionadas: <?php echo $cantidad_materias; ?></p>
<p>Costo total: $<?php echo number_format($costo_total, 2); ?></p>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="cantidad_ingresada">Ingrese la cantidad a pagar:</label>
    <input type="number" name="cantidad_ingresada" step="0.01" required>
    <input type="submit" value="Procesar Pago">
</form>

<?php
if (isset($error_pago)) {
    echo '<p style="color: red;">' . $error_pago . '</p>';
}
?>

<pre>

</pre>

</body>
</html>
