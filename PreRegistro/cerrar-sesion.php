<?php
session_start();

session_destroy();

header("Location: ../Aplicacion/login.php");
exit();
?>
