<?php
require_once "../../includes/auth.php";
require_once "../../includes/roles.php";
adminYComercial();
require_once "../../config/conexion.php";

include("../../includes/header.php");
include("../../includes/menu.php");

$sql = "SELECT * FROM licencias ORDER BY id_licencia DESC";
$resultado = mysqli_query($conexion, $sql);
?>

<div class="content">

<h2>Licencias</h2>

<!-- ✅ BOTÓN NUEVA LICENCIA -->
<div style="margin:15px 0;">
    <a href="agregar.php"
       style="
         padding:8px 14px;
         background:#0d6efd;
         color:#fff;
         text-decoration:none;
         border-radius:5px;
         margin-right:10px;
       ">
       ➕ Nueva Licencia
    </a>
</div>

<table border="1" cellpadding="10" cellspacing="0"
       style="width:100%; border-collapse:collapse;">

<tr style="background:#0d6efd; color:#fff;">
    <th>ID</th>
    <th>Tipo</th>
    <th>Estado</th>
    <th>Inicio</th>
    <th>Fin</th>
    <th>Acción</th>
</tr>

<?php if (mysqli_num_rows($resultado) > 0): ?>

<?php while($l = mysqli_fetch_assoc($resultado)): ?>
<tr>
    <td><?= $l['id_licencia'] ?></td>
    <td><?= htmlspecialchars($l['tipo']) ?></td>

    <td>
        <?php if($l['estado'] == 'Activa'): ?>
            <span style="color:green; font-weight:600;">Activa</span>
        <?php elseif($l['estado'] == 'Por vencer'): ?>
            <span style="color:orange; font-weight:600;">Por vencer</span>
        <?php else: ?>
            <span style="color:red; font-weight:600;">Vencida</span>
        <?php endif; ?>
    </td>

    <td><?= $l['fecha_inicio'] ?></td>
    <td><?= $l['fecha_fin'] ?></td>

    <!-- ✅ BOTÓN EDITAR -->
<td>
    <a href="editar.php?id=<?= $l['id_licencia'] ?>"
       style="
         padding:5px 8px;
         background:#ffc107;
         color:#000;
         text-decoration:none;
         border-radius:4px;
       ">
       ✏️
    </a>
</td>

</tr>


    </td>
</tr>
<?php endwhile; ?>

<?php else: ?>
<tr>
    <td colspan="6" style="text-align:center;">
        No hay licencias registradas
    </td>
</tr>
<?php endif; ?>

</table>

</div>

<?php include("../../includes/footer.php"); ?>

