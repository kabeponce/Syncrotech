<?php
require_once "../../includes/auth.php";
include("../../config/conexion.php");

$id = $_GET['id'];

$sql = "UPDATE servicios SET estado='Inactivo' WHERE id_servicio='$id'";
mysqli_query($conexion,$sql);

header("Location:listar.php");
exit();
?>