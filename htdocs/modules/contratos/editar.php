<?php
require_once "../../includes/auth.php";
require_once "../../includes/roles.php";
adminYComercial();
include("../../config/conexion.php");
include("../../includes/header.php");
include("../../includes/menu.php");

if (!isset($_GET['id'])) {
    header("Location: listar.php");
    exit();
}

$id = $_GET['id'];

/* OBTENER CONTRATO */
$sql = "SELECT * FROM contratos WHERE id_contrato='$id'";
$resultado = mysqli_query($conexion,$sql);
$fila = mysqli_fetch_assoc($resultado);

/* SELECTS */
$clientes = mysqli_query($conexion,"SELECT id_cliente,nombre1 FROM clientes");
$empleados = mysqli_query($conexion,"SELECT id_empleado,nombre1 FROM empleados");
$servicios = mysqli_query($conexion,"SELECT id_servicio,nombre FROM servicios");

/* ACTUALIZAR */
if($_POST){

$id_cliente = $_POST['id_cliente'];
$id_empleado = $_POST['id_empleado'];
$id_servicio = $_POST['id_servicio'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];
$valor = $_POST['valor'];
$estado = $_POST['estado'];

$update = "UPDATE contratos SET

id_cliente='$id_cliente',
id_empleado='$id_empleado',
id_servicio='$id_servicio',
fecha_inicio='$fecha_inicio',
fecha_fin='$fecha_fin',
valor='$valor',
estado='$estado'

WHERE id_contrato='$id'";

mysqli_query($conexion,$update);

// ✅ CAMBIO CORRECTO AQUÍ
echo "<script>
alert('Contrato actualizado correctamente');
window.location.href='listar.php';
</script>";
exit();
}
?>

<div class="content">
<div class="card">

<h1>Editar Contrato</h1>

<form method="POST">

<label>Cliente:</label><br>
<select name="id_cliente">
<?php while($c=mysqli_fetch_assoc($clientes)){ ?>
<option value="<?php echo $c['id_cliente']; ?>"
<?php if($fila['id_cliente']==$c['id_cliente']) echo "selected"; ?>>
<?php echo $c['nombre1']; ?>
</option>
<?php } ?>
</select>

<br><br>

<label>Empleado:</label><br>
<select name="id_empleado">
<?php while($e=mysqli_fetch_assoc($empleados)){ ?>
<option value="<?php echo $e['id_empleado']; ?>"
<?php if($fila['id_empleado']==$e['id_empleado']) echo "selected"; ?>>
<?php echo $e['nombre1']; ?>
</option>
<?php } ?>
</select>

<br><br>

<label>Servicio:</label><br>
<select name="id_servicio">
<?php while($s=mysqli_fetch_assoc($servicios)){ ?>
<option value="<?php echo $s['id_servicio']; ?>"
<?php if($fila['id_servicio']==$s['id_servicio']) echo "selected"; ?>>
<?php echo $s['nombre']; ?>
</option>
<?php } ?>
</select>

<br><br>

<label>Fecha inicio:</label><br>
<input type="date" name="fecha_inicio"
value="<?php echo $fila['fecha_inicio']; ?>">

<br><br>

<label>Fecha fin:</label><br>
<input type="date" name="fecha_fin"
value="<?php echo $fila['fecha_fin']; ?>">

<br><br>

<label>Valor:</label><br>
<input type="number" name="valor"
value="<?php echo $fila['valor']; ?>">

<br><br>

<label>Estado:</label><br>
<select name="estado">
<option <?php if($fila['estado']=="Activo") echo "selected"; ?>>Activo</option>
<option <?php if($fila['estado']=="Finalizado") echo "selected"; ?>>Finalizado</option>
</select>

<br><br>

<button type="submit">Actualizar</button>
<a href="listar.php">Volver</a>

</form>

</div>
</div>

<?php include("../../includes/footer.php"); ?>
