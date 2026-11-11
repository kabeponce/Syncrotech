<?php
require_once "../../includes/auth.php";
include("../../config/conexion.php");
include("../../includes/header.php");
include("../../includes/menu.php");

$id = $_GET['id'];

$sql = "SELECT * FROM incidencias WHERE id_incidencia='$id'";
$resultado = mysqli_query($conexion,$sql);
$fila = mysqli_fetch_assoc($resultado);

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

$update = "UPDATE incidencias SET

descripcion='$descripcion',
fecha_reporte='$fecha',
estado='$estado',
prioridad='$prioridad',
id_cliente='$id_cliente',
id_empleado='$id_empleado'

WHERE id_incidencia='$id'";

mysqli_query($conexion,$update);

header("Location:listar.php");
exit();

}
?>

<div class="content">
<div class="card">

<h1>Editar Incidencia</h1>

<form method="POST">

<textarea name="descripcion" rows="4" style="width:100%;" required><?php echo $fila['descripcion']; ?></textarea>

<br><br>

<label>Fecha:</label><br>
<input type="date" name="fecha"
value="<?php echo $fila['fecha_reporte']; ?>" required>

<br><br>

<label>Estado:</label><br>
<select name="estado">

<option <?php if($fila['estado']=="Abierta") echo "selected"; ?>>Abierta</option>
<option <?php if($fila['estado']=="En progreso") echo "selected"; ?>>En progreso</option>
<option <?php if($fila['estado']=="Cerrada") echo "selected"; ?>>Cerrada</option>
<option <?php if($fila['estado']=="Resuelta") echo "selected"; ?>>Resuelta</option>

</select>

<br><br>

<label>Prioridad:</label><br>
<select name="prioridad">

<option <?php if($fila['prioridad']=="Baja") echo "selected"; ?>>Baja</option>
<option <?php if($fila['prioridad']=="Media") echo "selected"; ?>>Media</option>
<option <?php if($fila['prioridad']=="Alta") echo "selected"; ?>>Alta</option>

</select>

<br><br>

<label>Cliente:</label><br>
<select name="id_cliente">

<?php while($c=mysqli_fetch_assoc($clientes)){ ?>

<option value="<?php echo $c['id_cliente']; ?>"
<?php if($fila['id_cliente']==$c['id_cliente']) echo "selected"; ?>>

<?php echo $c['nombre1']." ".$c['apellido1']; ?>

</option>

<?php } ?>

</select>

<br><br>

<label>Técnico:</label><br>
<select name="id_empleado">

<?php while($e=mysqli_fetch_assoc($empleados)){ ?>

<option value="<?php echo $e['id_empleado']; ?>"
<?php if($fila['id_empleado']==$e['id_empleado']) echo "selected"; ?>>

<?php echo $e['nombre1']." ".$e['apellido1']; ?>

</option>

<?php } ?>

</select>

<br><br>

<button type="submit">Actualizar</button>
<a href="listar.php">Volver</a>

</form>

</div>
</div>

<?php include("../../includes/footer.php"); ?>