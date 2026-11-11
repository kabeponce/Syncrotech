<?php
require_once "../../includes/auth.php";
require_once "../../includes/roles.php";
adminYComercial();
include("../../config/conexion.php");
include("../../includes/header.php");
include("../../includes/menu.php");

$sql = "SELECT * FROM clientes WHERE estado='Inactivo'";
$resultado = mysqli_query($conexion,$sql);
?>

<div class="content">

<div class="card">

<h1>Clientes Inactivos</h1>

<a href="listar.php">⬅ Volver a Activos</a>

<br><br>

<table border="1" width="100%" cellpadding="10">

<tr>
<th>ID</th>
<th>Nombre</th>
<th>Empresa</th>
<th>Correo</th>
<th>Acción</th>
</tr>

<?php while($fila=mysqli_fetch_assoc($resultado)){ ?>

<tr>

<td><?php echo $fila['id_cliente']; ?></td>

<td>
<?php
echo $fila['nombre1']." ".
$fila['apellido1'];
?>
</td>

<td><?php echo $fila['empresa']; ?></td>

<td><?php echo $fila['correo_electronico']; ?></td>

<td>
<a href="reactivar.php?id=<?php echo $fila['id_cliente']; ?>"
onclick="return confirm('¿Reactivar este cliente?')">
✅ Reactivar
</a>
</td>

</tr>

<?php } ?>

</table>

</div>

</div>

<?php include("../../includes/footer.php"); ?>