<?php
require_once "../../includes/auth.php";
require_once "../../includes/roles.php";
adminYComercial();
require_once "../../config/conexion.php";

if($_POST){

$tipo = $_POST['tipo'];
$estado = $_POST['estado'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];

$sql = "INSERT INTO licencias
(tipo, estado, fecha_inicio, fecha_fin)
VALUES
('$tipo','$estado','$fecha_inicio','$fecha_fin')";

mysqli_query($conexion, $sql);

header("Location: listar.php");
exit();
}

include("../../includes/header.php");
include("../../includes/menu.php");
?>

<div class="content">

<h2>Nueva Licencia</h2>

<form method="POST" style="max-width:400px;">

<label style="display:block; margin-bottom:5px;">Tipo</label>
<select name="tipo"
    style="width:100%; padding:8px; margin-bottom:12px;">
    <option value="Anual">Anual</option>
    <option value="Mensual">Mensual</option>
</select>

<label style="display:block; margin-bottom:5px;">Estado</label>
<select name="estado"
    style="width:100%; padding:8px; margin-bottom:12px;">
    <option value="Activa">Activa</option>
    <option value="Por vencer">Por vencer</option>
    <option value="Vencida">Vencida</option>
</select>

<label style="display:block; margin-bottom:5px;">Fecha Inicio</label>
<input type="date" name="fecha_inicio" required
    style="width:100%; padding:8px; margin-bottom:12px;">

<label style="display:block; margin-bottom:5px;">Fecha Fin</label>
<input type="date" name="fecha_fin" required
    style="width:100%; padding:8px; margin-bottom:12px;">

<button type="submit"
    style="
        padding:8px 14px;
        background:#0d6efd;
        color:#fff;
        border:none;
        border-radius:5px;
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
    Cancelar
</a>

</form>

</div>

<?php include("../../includes/footer.php"); ?>
``