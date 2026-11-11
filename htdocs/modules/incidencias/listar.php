<?php
require_once "../../includes/auth.php";
include("../../config/conexion.php");
include("../../includes/header.php");
include("../../includes/menu.php");

// Consulta base: une incidencias con clientes y empleados para mostrar nombres.
$sql = "SELECT i.*,
c.nombre1 AS cliente,
e.nombre1 AS empleado
FROM incidencias i
INNER JOIN clientes c ON i.id_cliente = c.id_cliente
INNER JOIN empleados e ON i.id_empleado = e.id_empleado
WHERE 1=1";

$busqueda = "";
if (isset($_GET['buscar']) && $_GET['buscar'] != "") {
    $busqueda = $_GET['buscar'];

    // Si el usuario busca algo, se agregan condiciones al WHERE.
    $sql .= " AND (
    i.descripcion LIKE '%$busqueda%'
    OR i.estado LIKE '%$busqueda%'
    OR i.prioridad LIKE '%$busqueda%'
    OR c.nombre1 LIKE '%$busqueda%'
    OR e.nombre1 LIKE '%$busqueda%'
    OR i.fecha_reporte LIKE '%$busqueda%'
    OR i.id_incidencia LIKE '%$busqueda%'
    )";
}

if (isset($_GET['estado'])) {
    $estado = $_GET['estado'];
    // Filtro por estado recibido desde los enlaces de filtro.
    $sql .= " AND i.estado='$estado'";
}

if (isset($_GET['prioridad'])) {
    $prioridad = $_GET['prioridad'];
    // Filtro por prioridad recibido desde los enlaces de filtro.
    $sql .= " AND i.prioridad='$prioridad'";
}

// Ejecuta la consulta final despues de aplicar busqueda y filtros.
$resultado = mysqli_query($conexion, $sql);
?>

<div class="content">
<div class="card">

<h1>Incidencias</h1>

<!-- Accion principal de la pagina. Usa .btn-app definido en style.css. -->
<div class="page-actions">
    <a class="btn-app" href="agregar.php">Nueva Incidencia</a>
</div>

<!-- Buscador con metodo GET para que la busqueda quede visible en la URL. -->
<form method="GET" class="search-form">
    <input type="text" name="buscar" placeholder="Buscar..."
    value="<?php echo $busqueda; ?>">

    <button type="submit">Buscar</button>
    <a href="listar.php">Limpiar</a>
</form>

<!-- Filtros visuales. Cada enlace recarga la pagina con un parametro GET. -->
<div class="filters-box">
    <strong>Filtrar por estado:</strong>
    <div class="filter-links">
        <a href="listar.php">Todas</a>
        <a href="listar.php?estado=Abierta">Abiertas</a>
        <a href="listar.php?estado=En progreso">En progreso</a>
        <a href="listar.php?estado=Cerrada">Cerradas</a>
    </div>
</div>

<div class="filters-box">
    <strong>Filtrar por prioridad:</strong>
    <div class="filter-links">
        <a href="listar.php?prioridad=Alta">Alta</a>
        <a href="listar.php?prioridad=Media">Media</a>
        <a href="listar.php?prioridad=Baja">Baja</a>
    </div>
</div>

<!-- table-responsive permite desplazamiento horizontal si la tabla es muy ancha. -->
<div class="table-responsive">
<table>
<tr>
<th>ID</th>
<th>Descripcion</th>
<th>Fecha</th>
<th>Estado</th>
<th>Prioridad</th>
<th>Cliente</th>
<th>Tecnico</th>
<th>Accion</th>
</tr>

<?php while ($fila = mysqli_fetch_assoc($resultado)) { ?>

<tr>
<td><?php echo $fila['id_incidencia']; ?></td>
<td><?php echo $fila['descripcion']; ?></td>
<td><?php echo $fila['fecha_reporte']; ?></td>

<td>
<?php
// Segun el estado, se muestra una etiqueta de color diferente.
if ($fila['estado'] == "Abierta") {
    echo "<span class='badge badge-red'>Abierta</span>";
} elseif ($fila['estado'] == "En progreso") {
    echo "<span class='badge badge-yellow'>En progreso</span>";
} elseif ($fila['estado'] == "Cerrada") {
    echo "<span class='badge badge-green'>Cerrada</span>";
} else {
    echo "<span class='badge badge-blue'>Resuelta</span>";
}
?>
</td>

<td>
<?php
// Segun la prioridad, se muestra una etiqueta de color diferente.
if ($fila['prioridad'] == "Alta") {
    echo "<span class='badge badge-red'>Alta</span>";
} elseif ($fila['prioridad'] == "Media") {
    echo "<span class='badge badge-yellow'>Media</span>";
} else {
    echo "<span class='badge badge-green'>Baja</span>";
}
?>
</td>

<td><?php echo $fila['cliente']; ?></td>
<td><?php echo $fila['empleado']; ?></td>
<td><a href="editar.php?id=<?php echo $fila['id_incidencia']; ?>">Editar</a></td>
</tr>

<?php } ?>

</table>
</div>

</div>
</div>

<?php include("../../includes/footer.php"); ?>
