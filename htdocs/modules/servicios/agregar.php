<?php
require_once "../../includes/auth.php";
include("../../config/conexion.php");
include("../../includes/header.php");
include("../../includes/menu.php");

if ($_POST) {

    $nombre = $_POST['nombre'];
    $tipo = $_POST['tipo'];
    $estado = $_POST['estado'];
    $precio = $_POST['precio'];

    // ✅ NULL real o entero
    $id_producto = !empty($_POST['id_producto']) ? intval($_POST['id_producto']) : "NULL";
    $id_licencia = !empty($_POST['id_licencia']) ? intval($_POST['id_licencia']) : "NULL";

    // ✅ ahora SÍ con precio
    $sql = "INSERT INTO servicios
    (nombre, tipo, estado, id_producto, id_licencia, precio)
    VALUES
    ('$nombre','$tipo','$estado',$id_producto,$id_licencia,'$precio')";

    if (!mysqli_query($conexion, $sql)) {
        die("ERROR AL GUARDAR: " . mysqli_error($conexion));
    }

    header("Location:listar.php");
    exit();
}
?>

<div class="content">
<div class="card">

<h1>Nuevo Servicio</h1>

<form method="POST" class="form-grid">

<div class="form-group">
    <label>Nombre</label>
    <input type="text" name="nombre" required>
</div>

<div class="form-group">
    <label>Tipo</label>
    <select name="tipo" required>
        <option value="Implementación">Implementación</option>
        <option value="Consultoría">Consultoría</option>
        <option value="Gestión">Gestión</option>
        <option value="Operación">Operación</option>
        <option value="Soporte">Soporte</option>
        <option value="Migración">Migración</option>
        <option value="Auditoría">Auditoría</option>
        <option value="Optimización">Optimización</option>
        <option value="Integración">Integración</option>
    </select>
</div>

<!-- ✅ PRECIO AÑADIDO -->
<div class="form-group">
    <label>Precio</label>
    <input type="number" name="precio" step="0.01" required>
</div>

<div class="form-group">
    <label>Estado</label>
    <select name="estado">
        <option value="Activo">Activo</option>
        <option value="Inactivo">Inactivo</option>
    </select>
</div>

<div class="form-group">
    <label>ID Producto (opcional)</label>
    <input type="number" name="id_producto">
</div>

<div class="form-group">
    <label>ID Licencia (opcional)</label>
    <input type="number" name="id_licencia">
</div>

<div class="form-actions">
    <button type="submit">Guardar</button>
    <a href="listar.php">Volver</a>
</div>

</form>

</div>
</div>

<?php include("../../includes/footer.php"); ?>

