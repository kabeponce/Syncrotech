<?php
require_once "../../includes/auth.php";
require_once "../../includes/roles.php";
adminYComercial();
require_once "../../config/conexion.php";

include("../../includes/header.php");
include("../../includes/menu.php");

// ✅ SOLO cambio aquí: agregado WHERE eliminado = 0
$sql = "
    SELECT 
        f.id_factura,
        f.fecha_emision,
        f.monto,
        f.metodo_pago,
        f.estado,
        f.id_contrato
    FROM facturas f
    WHERE f.eliminado = 0
    ORDER BY f.id_factura DESC
";

$resultado = mysqli_query($conexion, $sql);
?>

<div class="content">

<h2>Facturas</h2>

<div style="margin:15px 0;">
    <a href="agregar.php"
       style="
         display:inline-block;
         padding:10px 16px;
         background:#0d6efd;
         color:#fff;
         text-decoration:none;
         border-radius:6px;
         font-weight:600;
       ">
       ➕ Nueva factura
    </a>

    <a href="eliminadas.php"
       style="
         margin-left:10px;
         padding:10px 16px;
         background:#dc3545;
         color:#fff;
         text-decoration:none;
         border-radius:6px;
         font-weight:600;
       ">
       🗑 Ver eliminadas
    </a>
</div>

<table border="1" cellpadding="10" cellspacing="0"
       style="width:100%; border-collapse:collapse;">

    <tr style="background:#0d6efd; color:#fff;">
        <th>ID</th>
        <th>Fecha</th>
        <th>Monto</th>
        <th>Método</th>
        <th>Estado</th>
        <th>Contrato</th>
        <th>Acciones</th>
    </tr>

<?php if (mysqli_num_rows($resultado) > 0): ?>
    <?php while ($f = mysqli_fetch_assoc($resultado)): ?>
    <tr>
        <td><?= $f['id_factura'] ?></td>
        <td><?= $f['fecha_emision'] ?></td>

        <td>
            $<?= number_format($f['monto'], 0, ',', '.') ?>
        </td>

        <td><?= htmlspecialchars($f['metodo_pago']) ?></td>

        <td>
            <?php if ($f['estado'] == 'Pagada'): ?>
                <span style="color:green; font-weight:600;">Pagada</span>
            <?php else: ?>
                <span style="color:red; font-weight:600;">Pendiente</span>
            <?php endif; ?>
        </td>

        <td>#<?= $f['id_contrato'] ?></td>

        <td>
            <a href="editar.php?id=<?= $f['id_factura'] ?>"
               style="
                 padding:5px 8px;
                 background:#ffc107;
                 color:#000;
                 text-decoration:none;
                 border-radius:4px;
                 margin-right:5px;
               ">
               ✏️
            </a>

            <a href="eliminar.php?id=<?= $f['id_factura'] ?>"
               onclick="return confirm('¿Eliminar esta factura?');"
               style="
                 padding:5px 8px;
                 background:#dc3545;
                 color:#fff;
                 text-decoration:none;
                 border-radius:4px;
               ">
               🗑
            </a>
        </td>
    </tr>
    <?php endwhile; ?>

<?php else: ?>
    <tr>
        <td colspan="7" style="text-align:center;">
            No hay facturas registradas
        </td>
    </tr>
<?php endif; ?>

</table>

</div>

<?php include("../../includes/footer.php"); ?>