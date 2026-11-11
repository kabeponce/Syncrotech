<?php
require_once "../../includes/auth.php";
require_once "../../includes/roles.php";
adminYComercial();
require_once "../../config/conexion.php";

// ✅ validar ID
if (!isset($_GET['id'])) {
    header("Location: listar.php");
    exit;
}

$id = (int) $_GET['id'];

// ✅ obtener proyecto
$sql = "SELECT * FROM proyectos WHERE id_proyecto = $id";
$res = mysqli_query($conexion, $sql);
$proyecto = mysqli_fetch_assoc($res);

// ✅ si no existe
if (!$proyecto) {
    header("Location: listar.php");
    exit;
}

// ✅ contratos
$contratos = mysqli_query($conexion, "SELECT id_contrato FROM contratos");

// ✅ actualizar
if ($_POST) {

    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $inicio = $_POST['fecha_inicio'];
    $fin = $_POST['fecha_fin'];
    $estado = $_POST['estado'];
    $id_contrato = $_POST['id_contrato'];

    $sql = "UPDATE proyectos SET
        nombre='$nombre',
        descripcion='$descripcion',
        fecha_inicio='$inicio',
        fecha_fin='$fin',
        estado='$estado',
        id_contrato='$id_contrato'
    WHERE id_proyecto=$id";

    mysqli_query($conexion, $sql);

    header("Location: listar.php");
    exit;
}

include("../../includes/header.php");
include("../../includes/menu.php");
?>

<div class="content">

<h2>Editar Proyecto</h2>

<form method="POST" style="max-width:400px;">

<label style="display:block; margin-bottom:5px;">Nombre</label>
<input type="text" name="nombre"
    value="<?= htmlspecialchars($proyecto['nombre']) ?>"
    required style="width:100%; padding:8px; margin-bottom:12px;">

<label style="display:block; margin-bottom:5px;">Descripción</label>
<input type="text" name="descripcion"
    value="<?= htmlspecialchars($proyecto['descripcion']) ?>"
    required style="width:100%; padding:8px; margin-bottom:12px;">

<label style="display:block; margin-bottom:5px;">Fecha Inicio</label>
<input type="date" name="fecha_inicio"
    value="<?= $proyecto['fecha_inicio'] ?>"
    style="width:100%; padding:8px; margin-bottom:12px;">

<label style="display:block; margin-bottom:5px;">Fecha Fin</label>
<input type="date" name="fecha_fin"
    value="<?= $proyecto['fecha_fin'] ?>"
    style="width:100%; padding:8px; margin-bottom:12px;">

<label style="display:block; margin-bottom:5px;">Estado</label>
<select name="estado"
    style="width:100%; padding:8px; margin-bottom:12px;">
    <option value="Planificado" <?= $proyecto['estado']=="Planificado" ? "selected" : "" ?>>Planificado</option>
    <option value="En ejecución" <?= $proyecto['estado']=="En ejecución" ? "selected" : "" ?>>En ejecución</option>
    <option value="Finalizado" <?= $proyecto['estado']=="Finalizado" ? "selected" : "" ?>>Finalizado</option>
    <option value="Suspendido" <?= $proyecto['estado']=="Suspendido" ? "selected" : "" ?>>Suspendido</option>
</select>

<label style="display:block; margin-bottom:5px;">Contrato</label>
<select name="id_contrato"
    style="width:100%; padding:8px; margin-bottom:15px;">
<?php while($c=mysqli_fetch_assoc($contratos)): ?>
<option value="<?= $c['id_contrato'] ?>"
    <?= $proyecto['id_contrato']==$c['id_contrato'] ? "selected" : "" ?>>
    Contrato #<?= $c['id_contrato'] ?>
</option>
<?php endwhile; ?>
</select>

<!-- ✅ BOTONES BIEN HECHOS -->
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
