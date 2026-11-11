<?php
require_once "../../includes/auth.php";
require_once "../../config/conexion.php";
require_once "../../includes/roles.php";
adminYComercial();

// Cargar contratos
$contratos = mysqli_query($conexion,
    "SELECT id_contrato FROM contratos ORDER BY id_contrato"
);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $fecha   = $_POST['fecha'];
    $monto   = $_POST['monto'];
    $metodo  = $_POST['metodo'];
    $estado  = $_POST['estado'];
    $id_contrato = $_POST['id_contrato'];

    // ✅ INICIAR TRANSACCIÓN
    mysqli_begin_transaction($conexion);

    try {

        // ✅ INSERTAR FACTURA
        $stmt = mysqli_prepare($conexion,
            "INSERT INTO facturas
            (fecha_emision, monto, metodo_pago, estado, id_contrato, eliminado)
            VALUES (?, ?, ?, ?, ?, 0)"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "sdssi",
            $fecha,
            $monto,
            $metodo,
            $estado,
            $id_contrato
        );

        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception("Error al insertar factura");
        }

        // ✅ OBTENER ID DE LA FACTURA
        $id_factura = mysqli_insert_id($conexion);

        // ✅ SIMULACIÓN DE TRIGGER (LOG)
        if (!mysqli_query($conexion, "
            INSERT INTO log_facturas (id_factura, fecha)
            VALUES ($id_factura, NOW())
        ")) {
            throw new Exception("Error al insertar log");
        }

        // ✅ TODO OK → CONFIRMAR CAMBIOS
        mysqli_commit($conexion);

        header("Location: listar.php");
        exit;

    } catch (Exception $e) {

        // ❌ SI FALLA ALGO → REVERTIR TODO
        mysqli_rollback($conexion);

        echo "<div style='color:red;padding:10px;'>
                Error al guardar la factura
              </div>";
    }
}

include("../../includes/header.php");
include("../../includes/menu.php");
?>

<div class="content">

<h2>Nueva Factura</h2>

<form method="POST" style="max-width:400px;">

    <label>Fecha de emisión</label><br>
    <input type="date" name="fecha" required><br><br>

    <label>Monto</label><br>
    <input type="number" name="monto" required><br><br>

    <label>Método de pago</label><br>
    <select name="metodo" required>
        <option value="Transferencia">Transferencia</option>
        <option value="Efectivo">Efectivo</option>
        <option value="Crédito">Crédito</option>
        <option value="Débito">Débito</option>
    </select><br><br>

    <label>Estado</label><br>
    <select name="estado" required>
        <option value="Pagada">Pagada</option>
        <option value="Pendiente">Pendiente</option>
    </select><br><br>

    <label>Contrato</label><br>
    <select name="id_contrato" required>
        <option value="">Seleccione</option>
        <?php while($c = mysqli_fetch_assoc($contratos)): ?>
            <option value="<?= $c['id_contrato'] ?>">
                Contrato #<?= $c['id_contrato'] ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>

    <button type="submit"
            style="padding:8px 14px; background:#0d6efd; color:#fff;
                   border:none; border-radius:5px;">
        Guardar
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