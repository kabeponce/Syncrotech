<?php
require_once "../../includes/auth.php";
require_once "../../includes/roles.php";
soloAdmin();
include("../../config/conexion.php");
include("../../includes/header.php");
include("../../includes/menu.php");

if($_POST){

$nombre1 = $_POST['nombre1'];
$nombre2 = $_POST['nombre2'];
$apellido1 = $_POST['apellido1'];
$apellido2 = $_POST['apellido2'];
$cargo = $_POST['cargo'];
$telefono = $_POST['telefono'];

$sql = "INSERT INTO empleados
(nombre1,nombre2,apellido1,apellido2,cargo_laboral,telefono)

VALUES

('$nombre1','$nombre2','$apellido1','$apellido2','$cargo','$telefono')";

mysqli_query($conexion,$sql);

header("Location:listar.php");
exit();

}
?>

<div class="content">
<div class="card">

<h1>Nuevo Empleado</h1>

<form method="POST">

<input type="text" name="nombre1" placeholder="Primer nombre" required><br><br>

<input type="text" name="nombre2" placeholder="Segundo nombre"><br><br>

<input type="text" name="apellido1" placeholder="Primer apellido" required><br><br>

<input type="text" name="apellido2" placeholder="Segundo apellido"><br><br>

<input type="text" name="cargo" placeholder="Cargo laboral" required><br><br>

<input type="text" name="telefono" placeholder="Teléfono" required><br><br>

<button type="submit">Guardar</button>

<a href="listar.php">Volver</a>

</form>

</div>
</div>

<?php include("../../includes/footer.php"); ?>