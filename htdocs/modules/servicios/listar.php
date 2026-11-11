<?php
require_once "../../includes/auth.php";
include("../../config/conexion.php");
include("../../includes/header.php");
include("../../includes/menu.php");

$sql = "SELECT * FROM servicios";
$resultado = mysqli_query($conexion,$sql);
?>

<div class="content">
<div class="card">

<h1>Servicios</h1>

<a href="agregar.php">➕ Nuevo Servicio</a>

<br><br>

<table border="1" width="100%" cellpadding="10">

<tr>
<th>ID</th>
<th>Nombre</th>
<th>Tipo</th>
<th>Precio</th>
<th>Estado</th>
<th>Acción</th>
</tr>

<?php while($fila=mysqli_fetch_assoc($resultado)){ ?>

<tr>

<td><?php echo $fila['id_servicio']; ?></td>
<td><?php echo $fila['nombre']; ?></td>
<td><?php echo $fila['tipo']; ?></td>
<td>$<?php echo $fila['precio']; ?></td>

<td>
<?php
if($fila['estado']=="Activo"){
echo "<span class='badge badge-green'>Activo</span>";
}else{
echo "<span class='badge badge-red'>Inactivo</span>";
}
?>
</td>

<td>
<a href="editar.php?id=<?php echo $fila['id_servicio']; ?>">✏️</a>

<a href="eliminar.php?id=<?php echo $fila['id_servicio']; ?>"
onclick="return confirm('¿Desactivar este servicio?')">🗑️</a>
</td>

</tr>

<?php } ?>

</table>

</div>
</div>

<?php include("../../includes/footer.php"); ?>