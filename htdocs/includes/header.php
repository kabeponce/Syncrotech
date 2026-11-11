<?php
// Si no hay usuario en sesion, no se permite entrar al sistema.
if (!isset($_SESSION['usuario'])) {
    header("Location: /login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>SyncroTech Manager</title>

<link rel="icon" type="image/x-icon" href="/assets/favicon.ico">

<!-- Hoja de estilos descargada de la plantilla Simple Sidebar. -->
<link rel="stylesheet" href="/assets/css/template.css">

<!-- Hoja propia donde se personaliza la plantilla para SyncroTech. -->
<link rel="stylesheet" href="/assets/css/style.css">

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<!-- Contenedor principal que usa la estructura de la plantilla: menu lateral + contenido. -->
<div class="d-flex" id="wrapper">