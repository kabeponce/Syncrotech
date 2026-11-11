<?php
require_once "../../includes/auth.php";
require_once "../../includes/roles.php";
adminYComercial();
require_once "../../config/conexion.php";

// ✅ validar id
if (!isset($_GET['id'])) {
    header("Location: listar.php");
    exit;
}

$id = (int) $_GET['id'];

// ✅ obtener licencia actual
$sql = "SELECT * FROM licencias WHERE id_licencia = $id";
$resultado = mysqli_query($conexion, $sql);
$licencia = mysqli_fetch_assoc($resultado);

// ✅ si no existe
if (!$licencia) {
    header("Location: listar.php");
    exit;
}

// ✅ actualizar
if($_POST){

$tipo = $_POST['tipo'];
$estado = $_POST['estado'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];

$sql = "UPDATE licencias SET
tipo='$tipo',
estado='$estado',
fecha_inicio='$fecha_inicio',
fecha_fin='$fecha_fin'
WHERE id_licencia=$id";

mysqli_query($conexion, $sql);

header("Location: listar.php");
exit;
}

include("../../includes/header.php");
include("../../includes/menu.php");
?>

<div class="content">

<h2>Editar Licencia</h2>

<form method="POST" style="max-width:400px;">

<label style="display:block; margin-bottom:5px;">Tipo</label>
<select name="tipo"
    style="width:100%; padding:8px; margin-bottom:12px;">
    <option value="Anual" <?= $licencia['tipo']=="Anual" ? "selected" : "" ?>>Anual</option>
    <option value="Mensual" <?= $licencia['tipo']=="Mensual" ? "selected" : "" ?>>Mensual</option>
</select>

<label style="display:block; margin-bottom:5px;">Estado</label>
<select name="estado"
    style="width:100%; padding:8px; margin-bottom:12px;">
    <option value="Activa" <?= $licencia['estado']=="Activa" ? "selected" : "" ?>>Activa</option>
    <option value="Por vencer" <?= $licencia['estado']=="Por vencer" ? "selected" : "" ?>>Por vencer</option>
    <option value="Vencida" <?= $licencia['estado']=="Vencida" ? "selected" : "" ?>>Vencida</option>
</select>

<label style="display:block; margin-bottom:5px;">Fecha Inicio</label>
<input type="date" name="fecha_inicio"
    value="<?= date('Y-m-d', strtotime($licencia['fecha_inicio'])) ?>"
    style="width:100%; padding:8px; margin-bottom:12px;">

<label style="display:block; margin-bottom:5px;">Fecha Fin</label>
<input type="date" name="fecha_fin"
    value="<?= date('Y-m-d', strtotime($licencia['fecha_fin'])) ?>"
    style="width:100%; padding:8px; margin-bottom:12px;">

<button type="submit"
    style="
        padding:8px 14px;
        background:#0d6efd;
        color:#fff;
        border:none;
        border-radius:5px;
        cursor:pointer;
    ">
    Guardar cambios
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
   Cancelar
</a>

</form>

</div>

<?php include("../../includes/footer.php"); ?>
