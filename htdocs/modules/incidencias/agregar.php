<?php
require_once "../../includes/auth.php";
include("../../config/conexion.php");
include("../../includes/header.php");
include("../../includes/menu.php");

$clientes = mysqli_query($conexion,
"SELECT id_cliente,nombre1,apellido1 FROM clientes WHERE estado='Activo'");

$empleados = mysqli_query($conexion,
"SELECT id_empleado,nombre1,apellido1 FROM empleados WHERE estado='Activo'");

if($_POST){

$descripcion = $_POST['descripcion'];
$fecha = $_POST['fecha'];
$estado = $_POST['estado'];
$prioridad = $_POST['prioridad'];
$id_cliente = $_POST['id_cliente'];
$id_empleado = $_POST['id_empleado'];

$sql = "INSERT INTO incidencias
(descripcion,fecha_reporte,estado,prioridad,id_cliente,id_empleado)

VALUES

('$descripcion','$fecha','$estado','$prioridad','$id_cliente','$id_empleado')";

mysqli_query($conexion,$sql);

header("Location:listar.php");
exit();

}
?>

<div class="content">
<div class="card">

<h1>Nueva Incidencia</h1>

<form method="POST">

<textarea name="descripcion" placeholder="Descripción del problema"
required rows="4" style="width:100%;"></textarea>

<br><br>

<label>Fecha:</label><br>
<input type="date" name="fecha" required>

<br><br>

<label>Estado:</label><br>
<select name="estado" required>
<option value="Abierta">Abierta</option>
<option value="En progreso">En progreso</option>
<option value="Cerrada">Cerrada</option>
<option value="Resuelta">Resuelta</option>
</select>

<br><br>

<label>Prioridad:</label><br>
<select name="prioridad" required>
<option value="Baja">Baja</option>
<option value="Media">Media</option>
<option value="Alta">Alta</option>
</select>

<br><br>

<label>Cliente:</label><br>
<select name="id_cliente" required>

<?php while($c=mysqli_fetch_assoc($clientes)){ ?>

<option value="<?php echo $c['id_cliente']; ?>">
<?php echo $c['nombre1']." ".$c['apellido1']; ?>
</option>

<?php } ?>

</select>

<br><br>

<label>Técnico asignado:</label><br>
<select name="id_empleado" required>

<?php while($e=mysqli_fetch_assoc($empleados)){ ?>

<option value="<?php echo $e['id_empleado']; ?>">
<?php echo $e['nombre1']." ".$e['apellido1']; ?>
</option>

<?php } ?>

</select>

<br><br>

<button type="submit">Guardar Incidencia</button>

<a href="listar.php">Volver</a>

</form>

</div>
</div>

<?php include("../../includes/footer.php"); ?>