<?php
require_once "../../includes/auth.php";
require_once "../../includes/roles.php";
adminYComercial();
require_once "../../config/conexion.php";

include("../../includes/header.php");
include("../../includes/menu.php");

// ✅ SOLO cambio aquí: agregado WHERE eliminado = 1
$sql = "
    SELECT * FROM facturas
    WHERE eliminado = 1
    ORDER BY id_factura DESC
";

$resultado = mysqli_query($conexion, $sql);
?>

<div class="content">

<h2>Facturas eliminadas</h2>

<table border="1" cellpadding="10" cellspacing="0"
       style="width:100%; border-collapse:collapse;">

<tr style="background:#dc3545; color:#fff;">
    <th>ID</th>
    <th>Fecha</th>
    <th>Monto</th>
    <th>Método</th>
    <th>Estado</th>
    <th>Contrato</th>
</tr>

<?php if (mysqli_num_rows($resultado) > 0): ?>
    <?php while ($f = mysqli_fetch_assoc($resultado)): ?>
    <tr>
        <td><?= $f['id_factura'] ?></td>
        <td><?= $f['fecha_emision'] ?></td>
        <td>$<?= number_format($f['monto'], 0, ',', '.') ?></td>
        <td><?= htmlspecialchars($f['metodo_pago']) ?></td>

        <td>
            <?php if ($f['estado'] == 'Pagada'): ?>
                <span style="color:green; font-weight:600;">Pagada</span>
            <?php else: ?>
                <span style="color:red; font-weight:600;">Pendiente</span>
            <?php endif; ?>
        </td>

        <td>#<?= $f['id_contrato'] ?></td>
    </tr>
    <?php endwhile; ?>
<?php else: ?>
    <tr>
        <td colspan="6" style="text-align:center;">
            No hay facturas eliminadas
        </td>
    </tr>
<?php endif; ?>

</table>

<br>

<a href="listar.php"
   style="
     padding:8px 14px;
     background:#6c757d;
     color:#fff;
     text-decoration:none;
     border-radius:5px;
   ">
   ⬅ Volver
</a>

</div>

<?php include("../../includes/footer.php"); ?>
