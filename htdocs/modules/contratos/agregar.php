<?php
require_once "../../includes/auth.php";
require_once "../../includes/roles.php";
adminYComercial();
include("../../config/conexion.php");
include("../../includes/header.php");
include("../../includes/menu.php");

/* CARGAR DATOS PARA SELECTS */
$clientes = mysqli_query($conexion,"SELECT id_cliente,nombre1 FROM clientes");
$empleados = mysqli_query($conexion,"SELECT id_empleado,nombre1 FROM empleados");
$servicios = mysqli_query($conexion,"SELECT id_servicio,nombre FROM servicios");

/* GUARDAR */
if($_POST){

$id_cliente = $_POST['id_cliente'];
$id_empleado = $_POST['id_empleado'];
$id_servicio = $_POST['id_servicio'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];
$valor = $_POST['valor'];
$estado = $_POST['estado'];

$sql = "INSERT INTO contratos
(id_cliente,id_empleado,id_servicio,fecha_inicio,fecha_fin,valor,estado)
VALUES
('$id_cliente','$id_empleado','$id_servicio','$fecha_inicio','$fecha_fin','$valor','$estado')";

mysqli_query($conexion,$sql);

header("Location:listar.php");
exit();
}
?>

<div class="content">
<div class="card">

<h1 style="margin-bottom:20px;">Nuevo Contrato</h1>

<form method="POST" style="max-width:450px;">

<!-- CLIENTE -->
<label style="display:block; margin-bottom:5px; font-weight:600;">Cliente</label>
<select name="id_cliente" class="select2" required
    style="width:100%; padding:8px; margin-bottom:14px;">
<?php while($c=mysqli_fetch_assoc($clientes)){ ?>
<option value="<?php echo $c['id_cliente']; ?>">
<?php echo $c['id_cliente']." - ".$c['nombre1']; ?>
</option>
<?php } ?>
</select>

<!-- EMPLEADO -->
<label style="display:block; margin-bottom:5px; font-weight:600;">Empleado</label>
<select name="id_empleado" class="select2" required
    style="width:100%; padding:8px; margin-bottom:14px;">
<?php while($e=mysqli_fetch_assoc($empleados)){ ?>
<option value="<?php echo $e['id_empleado']; ?>">
<?php echo $e['id_empleado']." - ".$e['nombre1']; ?>
</option>
<?php } ?>
</select>

<!-- SERVICIO -->
<label style="display:block; margin-bottom:5px; font-weight:600;">Servicio</label>
<select name="id_servicio" class="select2" required
    style="width:100%; padding:8px; margin-bottom:14px;">
<?php while($s=mysqli_fetch_assoc($servicios)){ ?>
<option value="<?php echo $s['id_servicio']; ?>">
<?php echo $s['id_servicio']." - ".$s['nombre']; ?>
</option>
<?php } ?>
</select>

<!-- FECHAS -->
<label style="display:block; margin-bottom:5px; font-weight:600;">Fecha inicio</label>
<input type="date" name="fecha_inicio" required
    style="width:100%; padding:8px; margin-bottom:14px;">

<label style="display:block; margin-bottom:5px; font-weight:600;">Fecha fin</label>
<input type="date" name="fecha_fin" required
    style="width:100%; padding:8px; margin-bottom:14px;">

<!-- VALOR -->
<label style="display:block; margin-bottom:5px; font-weight:600;">Valor</label>
<input type="number" name="valor" required
    style="width:100%; padding:8px; margin-bottom:14px;">

<!-- ESTADO -->
<label style="display:block; margin-bottom:5px; font-weight:600;">Estado</label>
<select name="estado"
    style="width:100%; padding:8px; margin-bottom:18px;">
<option value="Activo">Activo</option>
<option value="Finalizado">Finalizado</option>
</select>

<!-- BOTONES -->
<button type="submit"
    style="
        padding:8px 14px;
        background:#0d6efd;
        color:#fff;
        border:none;
        border-radius:5px;
        cursor:pointer;
    ">
    Guardar
</button>

<a href="listar.php"
    style="
        margin-left:10px;
        padding:8px 14px;
        background:#6c757d;
        color:#fff;
        text-decoration:none;
        border-radius:5px;
    ">
    Volver
</a>

</form>

</div>
</div>

<?php include("../../includes/footer.php"); ?>
