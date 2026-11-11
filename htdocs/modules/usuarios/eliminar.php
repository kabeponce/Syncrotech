<?php
require_once "../../includes/auth.php";
require_once "../../includes/roles.php";
soloAdmin();
require_once "../../config/conexion.php";

if (!isset($_GET['user'])) {
    header("Location: listar.php");
    exit;
}

$user = $_GET['user'];

if ($user === $_SESSION['usuario']) {
    header("Location: listar.php");
    exit;
}

$stmt = mysqli_prepare($conexion,
    "SELECT r.nombre FROM usuarios u
     JOIN roles r ON u.id_rol = r.id_rol
     WHERE u.username = ?"
);
mysqli_stmt_bind_param($stmt, "s", $user);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($res);

if (!$row || $row['nombre'] === 'Administrador') {
    header("Location: listar.php");
    exit;
}

$stmt = mysqli_prepare($conexion,
    "DELETE FROM usuarios WHERE username = ?"
);
mysqli_stmt_bind_param($stmt, "s", $user);
mysqli_stmt_execute($stmt);

header("Location: listar.php");
exit;