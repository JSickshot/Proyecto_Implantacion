<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../logeos/login.php");
    exit();
}

$carpetaImagenes = "C:/xampp/htdocs/Proyecto_Implantacion/almacenar";

if (!file_exists($carpetaImagenes)) {
    mkdir($carpetaImagenes, 0777, true);
}

if (isset($_FILES['imagen'])) {
    $nombreArchivo = $_FILES['imagen']['name'];
    $rutaTemporal = $_FILES['imagen']['tmp_name'];

    $nombreUnico = uniqid() . '_' . $nombreArchivo;

    $rutaDestino = $carpetaImagenes . '/' . $nombreUnico;

    if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
        $conexion = new mysqli("localhost", "root", "", "proyectoimplantacion");

        if ($conexion->connect_error) {
            die("Conexión fallida: " . $conexion->connect_error);
        }

        $idUsuario = $_SESSION['usuario']['id'];

        $sqlActualizarImagen = "UPDATE usuarios SET ruta_imagen = '$rutaDestino' WHERE id = $idUsuario";
        $resultado = $conexion->query($sqlActualizarImagen);

        $conexion->close();

        if ($resultado) {
            echo '<script>';
            echo 'alert("Imagen subida correctamente.");';
            echo 'window.location.href = "A_principal.php";';  
            echo '</script>';
        } else {
            echo 'Error al actualizar la ruta de la imagen en la base de datos.';
        }
    } else {
        echo 'Error al mover el archivo a la carpeta de destino.';
    }
} else {
    echo 'No se ha seleccionado ningún archivo.';
}
?>
