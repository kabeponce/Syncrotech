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

$id = $_GET['id'];

// ✅ obtener datos
$factura = mysqli_fetch_assoc(
    mysqli_query($conexion, "SELECT * FROM facturas WHERE id_factura = $id")
);

// ✅ actualizar
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fecha  = $_POST['fecha_emision'];
    $monto  = $_POST['monto'];
    $metodo = $_POST['metodo_pago'];
    $estado = $_POST['estado'];

    mysqli_query($conexion, "
        UPDATE facturas SET
        fecha_emision='$fecha',
        monto='$monto',
        metodo_pago='$metodo',
        estado='$estado'
        WHERE id_factura=$id
    ");

    header("Location: listar.php");
    exit;
}

include("../../includes/header.php");
include("../../includes/menu.php");
?>

<div class="content">

<h2>Editar Factura</h2>

<form method="POST" style="max-width:400px;">

    <label>Fecha de emisión</label><br>
    <input type="date" name="fecha_emision"
           value="<?= $factura['fecha_emision'] ?>" required><br><br>

    <label>Monto</label><br>
    <input type="number" name="monto"
           value="<?= $factura['monto'] ?>" required><br><br>

    <label>Método de pago</label><br>
    <select name="metodo_pago">
        <option value="Transferencia" <?= $factura['metodo_pago']=='Transferencia'?'selected':'' ?>>Transferencia</option>
        <option value="Efectivo" <?= $factura['metodo_pago']=='Efectivo'?'selected':'' ?>>Efectivo</option>
        <option value="Crédito" <?= $factura['metodo_pago']=='Crédito'?'selected':'' ?>>Crédito</option>
        <option value="Débito" <?= $factura['metodo_pago']=='Débito'?'selected':'' ?>>Débito</option>
    </select><br><br>

    <label>Estado</label><br>
    <select name="estado">
        <option value="Pagada" <?= $factura['estado']=='Pagada'?'selected':'' ?>>Pagada</option>
        <option value="Pendiente" <?= $factura['estado']=='Pendiente'?'selected':'' ?>>Pendiente</option>
    </select><br><br>

    <!-- BOTONES -->
    <button type="submit"
        style="padding:8px 14px; background:#0d6efd; color:#fff;
        border:none; border-radius:5px;">
        Actualizar
    </button>

    <a href="listar.php"
       style="margin-left:10px; padding:8px 14px;
       background:#6c757d; color:#fff;
       text-decoration:none; border-radius:5px;">
       Cancelar
    </a>

</form>

</div>

<?php include("../../includes/footer.php"); ?>

