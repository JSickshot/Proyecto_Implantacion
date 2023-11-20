<?php
session_start();

session_destroy();

header("Location: ../Logeos/login.php");
exit();
?>
