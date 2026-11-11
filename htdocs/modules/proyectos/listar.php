<?php
require_once "../../includes/auth.php";
require_once "../../includes/roles.php";
adminYComercial();
require_once "../../config/conexion.php";

include("../../includes/header.php");
include("../../includes/menu.php");

// ✅ Consulta segura
$sql = "
SELECT p.*, c.id_contrato
FROM proyectos p
LEFT JOIN contratos c ON p.id_contrato = c.id_contrato
ORDER BY p.id_proyecto DESC
";

$resultado = mysqli_query($conexion, $sql);

// ✅ Validar error SQL
if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($conexion));
}
?>

<div class="content">

<h2>Proyectos</h2>

<!-- ✅ BOTÓN NUEVO PROYECTO -->
<div style="margin:15px 0;">
    <a href="agregar.php"
       style="
         padding:8px 14px;
         background:#0d6efd;
         color:#fff;
         text-decoration:none;
         border-radius:5px;
         font-weight:600;
       ">
       ➕ Nuevo Proyecto
    </a>
</div>

<table border="1" style="width:100%; border-collapse:collapse;">

<tr style="background:#0d6efd; color:#fff;">
    <th>ID</th>
    <th>Nombre</th>
    <th>Descripción</th>
    <th>Inicio</th>
    <th>Fin</th>
    <th>Estado</th>
    <th>Contrato</th>
    <th>Acción</th>
</tr>

<?php if (mysqli_num_rows($resultado) > 0): ?>

<?php while($p = mysqli_fetch_assoc($resultado)): ?>
<tr>

<td><?= $p['id_proyecto'] ?></td>

<td><?= htmlspecialchars($p['nombre']) ?></td>

<td><?= htmlspecialchars($p['descripcion']) ?></td>

<td><?= $p['fecha_inicio'] ?></td>

<td><?= $p['fecha_fin'] ?></td>

<!-- ✅ ESTADO PRO (CORRECTO) -->
<td>
<?php
if($p['estado']=="Planificado"){
    echo "<span style='color:gray; font-weight:600;'>Planificado</span>";
}elseif($p['estado']=="En ejecución"){
    echo "<span style='color:orange; font-weight:600;'>En ejecución</span>";
}elseif($p['estado']=="Finalizado"){
    echo "<span style='color:green; font-weight:600;'>Finalizado</span>";
}elseif($p['estado']=="Suspendido"){
    echo "<span style='color:red; font-weight:600;'>Suspendido</span>";
}else{
    echo "<span style='font-weight:600;'>".$p['estado']."</span>";
}
?>
</td>

<td>
    <?= $p['id_contrato'] ? "#".$p['id_contrato'] : "Sin contrato" ?>
</td>

<!-- ✅ BOTÓN EDITAR PERFECTO -->
<td>
    <a href="editar.php?id=<?= $p['id_proyecto'] ?>"
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
<?php endwhile; ?>

<?php else: ?>
<tr>
    <td colspan="8" style="text-align:center;">
        No hay proyectos registrados
    </td>
</tr>
<?php endif; ?>

</table>

</div>

<?php include("../../includes/footer.php"); ?>


