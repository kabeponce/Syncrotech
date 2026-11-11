<?php
require_once "../../includes/auth.php";
require_once "../../includes/roles.php";
adminYComercial();
include("../../config/conexion.php");
include("../../includes/header.php");
include("../../includes/menu.php");

$id = $_GET['id'];

$sql = "SELECT * FROM clientes WHERE id_cliente='$id'";
$resultado = mysqli_query($conexion,$sql);
$fila = mysqli_fetch_assoc($resultado);

if($_POST){

$nombre1 = $_POST['nombre1'];
$nombre2 = $_POST['nombre2'];
$apellido1 = $_POST['apellido1'];
$apellido2 = $_POST['apellido2'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$empresa = $_POST['empresa'];

$update = "UPDATE clientes SET

nombre1='$nombre1',
nombre2='$nombre2',
apellido1='$apellido1',
apellido2='$apellido2',
telefono='$telefono',
correo_electronico='$correo',
empresa='$empresa'

WHERE id_cliente='$id'";

mysqli_query($conexion,$update);

header("Location:listar.php");
exit();

}
?>

<div class="content">

<div class="card">

<h1>Editar Cliente</h1>

<form method="POST">

<input type="text" name="nombre1" value="<?php echo $fila['nombre1']; ?>" required><br><br>

<input type="text" name="nombre2" value="<?php echo $fila['nombre2']; ?>"><br><br>

<input type="text" name="apellido1" value="<?php echo $fila['apellido1']; ?>" required><br><br>

<input type="text" name="apellido2" value="<?php echo $fila['apellido2']; ?>"><br><br>

<input type="text" name="telefono" value="<?php echo $fila['telefono']; ?>" required><br><br>

<input type="email" name="correo" value="<?php echo $fila['correo_electronico']; ?>" required><br><br>

<input type="text" name="empresa" value="<?php echo $fila['empresa']; ?>" required><br><br>

<button type="submit">Actualizar</button>

<a href="listar.php">Volver</a>

</form>

</div>

</div>

<?php include("../../includes/footer.php"); ?>