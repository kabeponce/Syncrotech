<?php
require_once "../../includes/auth.php";
require_once "../../includes/roles.php";
adminYComercial();
require_once "../../config/conexion.php";

if (!isset($_GET['id'])) {
    header("Location: listar.php");
    exit();
}

$id = $_GET['id'];

// ✅ NO borrar → DESACTIVAR
$sql = "UPDATE clientes 
        SET estado = 'Inactivo'
        WHERE id_cliente = '$id'";

mysqli_query($conexion, $sql);

header("Location: listar.php");
exit();
?>
