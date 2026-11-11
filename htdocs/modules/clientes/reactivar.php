<?php
require_once "../../includes/auth.php";
require_once "../../includes/roles.php";
adminYComercial();
include("../../config/conexion.php");

$id = $_GET['id'];

$sql = "UPDATE clientes
        SET estado='Activo'
        WHERE id_cliente='$id'";

mysqli_query($conexion,$sql);

header("Location:inactivos.php");
exit();
?>