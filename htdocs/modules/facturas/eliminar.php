<?php
require_once "../../includes/auth.php";
require_once "../../includes/roles.php";
adminYComercial();
require_once "../../config/conexion.php";

if (!isset($_GET['id'])) {
    header("Location: listar.php");
    exit;
}

$id = (int) $_GET['id'];

// ✅ quitar DELETE y usar papelera
$stmt = mysqli_prepare($conexion,
    "UPDATE facturas SET eliminado = 1 WHERE id_factura = ?"
);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

header("Location: listar.php");
exit;
?>


