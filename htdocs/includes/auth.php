<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: /syncrotech_manager/login.php");
    exit;
}
?>
