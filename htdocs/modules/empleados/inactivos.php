<?php
require_once "../../includes/auth.php";
require_once "../../includes/roles.php";
soloAdmin();
include("../../config/conexion.php");
include("../../includes/header.php");
include("../../includes/menu.php");

$sql = "SELECT * FROM empleados WHERE estado='Inactivo'";
$resultado = mysqli_query($conexion,$sql);
?>

<div class="content">
<div class="card">

<h1>Empleados Inactivos</h1>

<a href="listar.php">⬅ Volver</a>

<br><br>

<table border="1" width="100%" cellpadding="10">

<tr>
<th>ID</th>
<th>Nombre</th>
<th>Cargo</th>
<th>Teléfono</th>
<th>Acción</th>
</tr>

<?php while($fila=mysqli_fetch_assoc($resultado)){ ?>

<tr>

<td><?php echo $fila['id_empleado']; ?></td>

<td>
<?php
echo $fila['nombre1']." ".
$fila['apellido1'];
?>
</td>

<td><?php echo $fila['cargo_laboral']; ?></td>
<td><?php echo $fila['telefono']; ?></td>

<td>
<a href="reactivar.php?id=<?php echo $fila['id_empleado']; ?>"
onclick="return confirm('¿Reactivar empleado?')">
✅ Reactivar
</a>
</td>

</tr>

<?php } ?>

</table>

</div>
</div>

<?php include("../../includes/footer.php"); ?>