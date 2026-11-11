<?php
require_once "../../includes/auth.php";
require_once "../../includes/roles.php";
soloAdmin();
include("../../config/conexion.php");

$id = $_GET['id'];

$sql = "UPDATE empleados
        SET estado='Activo'
        WHERE id_empleado='$id'";

mysqli_query($conexion,$sql);

header("Location:inactivos.php");
exit();
?>