<?php
require_once "../../includes/auth.php";
require_once "../../includes/roles.php";
adminYComercial();
include("../../config/conexion.php");
include("../../includes/header.php");
include("../../includes/menu.php");

// 🔍 Obtener texto de búsqueda
$buscar = isset($_GET['buscar']) ? trim($_GET['buscar']) : '';

// ✅ Consulta base (SIN filtrar estado)
$sql = "SELECT con.*, 
c.nombre1 AS cliente,
e.nombre1 AS empleado,
s.nombre AS servicio

FROM contratos con
INNER JOIN clientes c ON con.id_cliente = c.id_cliente
INNER JOIN empleados e ON con.id_empleado = e.id_empleado
INNER JOIN servicios s ON con.id_servicio = s.id_servicio";

// ✅ Si hay búsqueda
if ($buscar !== '') {
    $buscar_safe = mysqli_real_escape_string($conexion, $buscar);

    $sql .= " WHERE 
        c.nombre1 LIKE '%$buscar_safe%' OR
        e.nombre1 LIKE '%$buscar_safe%' OR
        s.nombre LIKE '%$buscar_safe%'";
}

$resultado = mysqli_query($conexion,$sql);
?>

<div class="content">
<div class="card">

<h1>Contratos</h1>

<a href="agregar.php">➕ Nuevo Contrato</a>

<br><br>

<form method="GET" style="margin-bottom:15px;">
    <input type="text" name="buscar"
        placeholder="Buscar cliente, empleado o servicio..."
        value="<?= htmlspecialchars($buscar) ?>"
        style="padding:8px; width:300px; border-radius:5px; border:1px solid #ccc;">

    <button type="submit"
        style="padding:8px 12px; background:#0d6efd; color:#fff; border:none; border-radius:5px;">
        Buscar
    </button>
</form>

<table>

<tr>
<th>ID</th>
<th>Cliente</th>
<th>Empleado</th>
<th>Servicio</th>
<th>Inicio</th>
<th>Fin</th>
<th>Valor</th>
<th>Estado</th>
<th>Acción</th>
</tr>

<?php while($fila=mysqli_fetch_assoc($resultado)){ ?>

<tr>

<td><?php echo $fila['id_contrato']; ?></td>

<td><?php echo $fila['cliente']; ?></td>

<td><?php echo $fila['empleado']; ?></td>

<td><?php echo $fila['servicio']; ?></td>

<td><?php echo $fila['fecha_inicio']; ?></td>

<td><?php echo $fila['fecha_fin']; ?></td>

<td>$<?php echo number_format($fila['valor']); ?></td>

<td>
<?php
if($fila['estado']=="Activo"){
echo "<span class='badge badge-green'>Activo</span>";
}else{
echo "<span class='badge badge-red'>Finalizado</span>";
}
?>
</td>

<td>
<a href="editar.php?id=<?php echo $fila['id_contrato']; ?>">✏️</a>
</td>

</tr>

<?php } ?>

</table>

</div>
</div>

<?php include("../../includes/footer.php"); ?>