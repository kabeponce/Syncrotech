<?php
require_once "../../includes/auth.php";
include("../../config/conexion.php");

if (!isset($_GET['id'])) {
    header("Location: listar.php");
    exit();
}

$id = intval($_GET['id']);

/* CONSULTAR SERVICIO */
$sql = "SELECT * FROM servicios WHERE id_servicio=$id";
$resultado = mysqli_query($conexion,$sql);

if (!$resultado || mysqli_num_rows($resultado) == 0) {
    echo "Servicio no encontrado";
    exit();
}

$fila = mysqli_fetch_assoc($resultado);

/* ACTUALIZAR */
if($_SERVER['REQUEST_METHOD']=="POST"){

$nombre = $_POST['nombre'];
$tipo = $_POST['tipo'];
$estado = $_POST['estado'];
$precio = $_POST['precio']; // ✅ NUEVO

$id_producto = empty($_POST['id_producto']) ? "NULL" : intval($_POST['id_producto']);
$id_licencia = empty($_POST['id_licencia']) ? "NULL" : intval($_POST['id_licencia']);

$sql = "UPDATE servicios SET
nombre='$nombre',
tipo='$tipo',
estado='$estado',
precio='$precio',  /* ✅ NUEVO */
id_producto=$id_producto,
id_licencia=$id_licencia
WHERE id_servicio=$id";

if (!mysqli_query($conexion,$sql)) {
    die("Error SQL: " . mysqli_error($conexion));
}

header("Location:listar.php");
exit();
}

include("../../includes/header.php");
include("../../includes/menu.php");
?>

<div class="content">
<div class="card">

<h1>Editar Servicio</h1>

<form method="POST">

<label>Nombre</label>
<input type="text" name="nombre" value="<?= $fila['nombre']; ?>" required>

<label>Tipo</label>
<select name="tipo">
<option <?= ($fila['tipo']=="Implementación")?"selected":"" ?>>Implementación</option>
<option <?= ($fila['tipo']=="Consultoría")?"selected":"" ?>>Consultoría</option>
<option <?= ($fila['tipo']=="Gestión")?"selected":"" ?>>Gestión</option>
<option <?= ($fila['tipo']=="Operación")?"selected":"" ?>>Operación</option>
<option <?= ($fila['tipo']=="Soporte")?"selected":"" ?>>Soporte</option>
<option <?= ($fila['tipo']=="Migración")?"selected":"" ?>>Migración</option>
<option <?= ($fila['tipo']=="Auditoría")?"selected":"" ?>>Auditoría</option>
<option <?= ($fila['tipo']=="Optimización")?"selected":"" ?>>Optimización</option>
<option <?= ($fila['tipo']=="Integración")?"selected":"" ?>>Integración</option>
</select>

<!-- ✅ NUEVO CAMPO PRECIO -->
<label>Precio</label>
<input type="number" name="precio" step="0.01" value="<?= $fila['precio']; ?>">

<label>Estado</label>
<select name="estado">
<option value="Activo" <?= ($fila['estado']=="Activo")?"selected":"" ?>>Activo</option>
<option value="Inactivo" <?= ($fila['estado']=="Inactivo")?"selected":"" ?>>Inactivo</option>
</select>

<label>ID Producto</label>
<input type="number" name="id_producto" value="<?= $fila['id_producto']; ?>">

<label>ID Licencia</label>
<input type="number" name="id_licencia" value="<?= $fila['id_licencia']; ?>">

<br><br>

<button type="submit">Actualizar</button>
<a href="listar.php">Volver</a>

</form>

</div>
</div>

<?php include("../../includes/footer.php"); ?>