<?php
require_once "includes/auth.php";
require_once "config/conexion.php";
require_once "includes/roles.php";

include("includes/header.php");
include("includes/menu.php");

/* === DATOS === */

//  se quitó estado donde no existe
$clientes = mysqli_fetch_assoc(mysqli_query($conexion,
"SELECT COUNT(*) total FROM clientes"));

$empleados = mysqli_fetch_assoc(mysqli_query($conexion,
"SELECT COUNT(*) total FROM empleados"));

$incidencias = mysqli_fetch_assoc(mysqli_query($conexion,
"SELECT COUNT(*) total FROM incidencias WHERE estado='Abierta'"));

$contratos = mysqli_fetch_assoc(mysqli_query($conexion,
"SELECT COUNT(*) total FROM contratos"));

$servicios = mysqli_fetch_assoc(mysqli_query($conexion,
"SELECT COUNT(*) total FROM servicios"));

$criticas = mysqli_fetch_assoc(mysqli_query($conexion,
"SELECT COUNT(*) total FROM incidencias 
 WHERE prioridad='Alta' AND estado='Abierta'"));

$facturas = mysqli_fetch_assoc(mysqli_query($conexion,
"SELECT COUNT(*) total FROM facturas"));
?>

<div class="content">

<h1 class="titulo-dashboard">📊 DASHBOARD</h1>

<div class="welcome-box">
    <h2>Bienvenido <?= $_SESSION['usuario']; ?></h2>
    <p>Centro de monitoreo Syncrotech Manager</p>
</div>

<!-- 🔥 ALERTA -->
<?php if ($criticas['total'] > 0 && in_array($_SESSION['rol'], [1,2])): ?>
<div class="card" style="background:#fee2e2; border-left:6px solid #ef4444;">
    <h3 style="margin:0;">🚨 Atención</h3>
    <p style="margin:5px 0 0 0;">
        Tienes <?= $criticas['total']; ?> incidencias críticas abiertas
    </p>
</div>
<?php endif; ?>

<div class="stats-grid">

<?php if (in_array($_SESSION['rol'], [1,3])): ?>
<div class="stat-card blue" onclick="window.location='modules/clientes/listar.php'">
    <h3>👥 Clientes</h3>
    <p><?= $clientes['total'] ?></p>
</div>
<?php endif; ?>

<?php if ($_SESSION['rol'] == 1): ?>
<div class="stat-card green" onclick="window.location='modules/empleados/listar.php'">
    <h3>👨‍💼 Empleados</h3>
    <p><?= $empleados['total'] ?></p>
</div>
<?php endif; ?>

<?php if (in_array($_SESSION['rol'], [1,2])): ?>
<div class="stat-card red" onclick="window.location='modules/incidencias/listar.php'">
    <h3>⚠️ Incidencias abiertas</h3>
    <p><?= $incidencias['total'] ?></p>
</div>
<?php endif; ?>

<?php if (in_array($_SESSION['rol'], [1,3])): ?>
<div class="stat-card orange" onclick="window.location='modules/contratos/listar.php'">
    <h3>📄 Contratos activos</h3>
    <p><?= $contratos['total'] ?></p>
</div>
<?php endif; ?>

<?php if (in_array($_SESSION['rol'], [1,2])): ?>
<div class="stat-card blue" onclick="window.location='modules/servicios/listar.php'">
    <h3>🛠️ Servicios</h3>
    <p><?= $servicios['total'] ?></p>
</div>
<?php endif; ?>

<?php if (in_array($_SESSION['rol'], [1,3])): ?>
<div class="stat-card green" onclick="window.location='modules/facturas/listar.php'">
    <h3>🧾 Facturas</h3>
    <p><?= $facturas['total'] ?></p>
</div>
<?php endif; ?>

</div>

</div>

<?php include("includes/footer.php"); ?>