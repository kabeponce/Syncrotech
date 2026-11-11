<?php
require_once "../../includes/auth.php";
require_once "../../includes/roles.php";
soloAdmin();
include("../../config/conexion.php");
include("../../includes/header.php");
include("../../includes/menu.php");

$busqueda = "";

if(isset($_GET['buscar'])){
$busqueda = $_GET['buscar'];

$sql = "SELECT * FROM empleados
WHERE estado='Activo' AND (

nombre1 LIKE '%$busqueda%' OR
nombre2 LIKE '%$busqueda%' OR
apellido1 LIKE '%$busqueda%' OR
apellido2 LIKE '%$busqueda%' OR
cargo_laboral LIKE '%$busqueda%'

)";
}else{
$sql = "SELECT * FROM empleados WHERE estado='Activo'";
}

$resultado = mysqli_query($conexion,$sql);
?>

<div class="content">
<div class="card">

<h1>Empleados</h1>

<a href="agregar.php">➕ Nuevo Empleado</a>
<a href="inactivos.php">📁 Ver Inactivos</a>

<br><br>

<form method="GET">
<input type="text" name="buscar" placeholder="Buscar empleado..."
value="<?php echo $busqueda; ?>">
<button type="submit">Buscar</button>
<a href="listar.php">Limpiar</a>
</form>

<br>

<table border="1" width="100%" cellpadding="10">

<tr>
<th>ID</th>
<th>Nombre</th>
<th>Cargo</th>
<th>Teléfono</th>
<th>Acciones</th>
</tr>

<?php while($fila=mysqli_fetch_assoc($resultado)){ ?>

<tr>

<td><?php echo $fila['id_empleado']; ?></td>

<td>
<?php
echo $fila['nombre1']." ".
$fila['nombre2']." ".
$fila['apellido1']." ".
$fila['apellido2'];
?>
</td>

<td><?php echo $fila['cargo_laboral']; ?></td>
<td><?php echo $fila['telefono']; ?></td>

<td>
<a href="editar.php?id=<?php echo $fila['id_empleado']; ?>">✏️</a>

<a href="eliminar.php?id=<?php echo $fila['id_empleado']; ?>"
onclick="return confirm('¿Desactivar empleado?')">
🚫
</a>
</td>

</tr>

<?php } ?>

</table>

</div>
</div>

<?php include("../../includes/footer.php"); ?>
