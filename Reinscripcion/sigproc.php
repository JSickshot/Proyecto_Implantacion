<?php
session_start();
include_once "../Conexion/db_config.php";

$query = "SELECT cursos.id_curso, cursos.nombre_curso, usuarios.nombre as nombre_profesor
          FROM cursos
          INNER JOIN usuarios ON cursos.id_profesor = usuarios.id";

$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    $available_courses = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $available_courses = array();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $_SESSION['selected_courses'] = isset($_POST['selected_courses']) ? $_POST['selected_courses'] : array();

    $_SESSION['cantidad_materias'] = count($_SESSION['selected_courses']);

    header("Location: pagos.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selección de Materias</title>
</head>
<body>

<h1>Pago de materias</h1>
<h2>¿Cuántas materias deseas inscribir?</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <?php
    foreach ($available_courses as $course) {
        echo '<input type="checkbox" name="selected_courses[]" value="' . $course['id_curso'] . '">' . $course['nombre_curso'] . ' - Profesor: ' . $course['nombre_profesor'] . '<br>';
    }
    ?>
    <br>
    <input type="submit" value="Procesar Selección">
</form>

</body>
</html>
