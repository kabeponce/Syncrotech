<?php
require_once "../../includes/auth.php";
require_once "../../includes/roles.php";
adminYComercial();
require_once "../../config/conexion.php";

// 🔥 contratos para seleccionar
$contratos = mysqli_query($conexion,
    "SELECT id_contrato FROM contratos"
);

if($_POST){

$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$inicio = $_POST['fecha_inicio'];
$fin = $_POST['fecha_fin'];
$estado = $_POST['estado'];
$id_contrato = $_POST['id_contrato'];

$sql = "INSERT INTO proyectos
(nombre, descripcion, fecha_inicio, fecha_fin, estado, id_contrato)
VALUES
('$nombre','$descripcion','$inicio','$fin','$estado','$id_contrato')";

mysqli_query($conexion, $sql);

header("Location: listar.php");
exit;
}

include("../../includes/header.php");
include("../../includes/menu.php");
?>

<div class="content">

<h2>Nuevo Proyecto</h2>

<form method="POST" style="max-width:400px;">

<label style="display:block; margin-bottom:5px;">Nombre</label>
<input type="text" name="nombre" required
    style="width:100%; padding:8px; margin-bottom:12px;">

<label style="display:block; margin-bottom:5px;">Descripción</label>
<input type="text" name="descripcion" required
    style="width:100%; padding:8px; margin-bottom:12px;">

<label style="display:block; margin-bottom:5px;">Fecha Inicio</label>
<input type="date" name="fecha_inicio" required
    style="width:100%; padding:8px; margin-bottom:12px;">

<label style="display:block; margin-bottom:5px;">Fecha Fin</label>
<input type="date" name="fecha_fin"
    style="width:100%; padding:8px; margin-bottom:12px;">

<label style="display:block; margin-bottom:5px;">Estado</label>
<select name="estado"
    style="width:100%; padding:8px; margin-bottom:12px;">
    <option value="Activo">Activo</option>
    <option value="En ejecución">En ejecución</option>
</select>

<label style="display:block; margin-bottom:5px;">Contrato</label>
<select name="id_contrato" required
    style="width:100%; padding:8px; margin-bottom:15px;">
<?php while($c=mysqli_fetch_assoc($contratos)): ?>
<option value="<?= $c['id_contrato'] ?>">
    Contrato #<?= $c['id_contrato'] ?>
</option>
<?php endwhile; ?>
</select>

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
   Cancelar
</a>

</form>

</div>

<?php include("../../includes/footer.php"); ?>
