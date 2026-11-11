<?php
require_once "../../includes/auth.php";
require_once "../../includes/roles.php";
soloAdmin();
require_once "../../config/conexion.php";

if (!isset($_GET['user'])) {
    header("Location: listar.php");
    exit;
}

$username = $_GET['user'];

// Obtener datos del usuario
$stmt = mysqli_prepare($conexion, "
    SELECT u.username, u.id_rol, e.nombre1, e.apellido1
    FROM usuarios u
    INNER JOIN empleados e ON u.id_empleado = e.id_empleado
    WHERE u.username = ?
");
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$usuario = mysqli_fetch_assoc($result);

if (!$usuario) {
    header("Location: listar.php");
    exit;
}

// Cargar roles
$roles = mysqli_query($conexion, "SELECT id_rol, nombre FROM roles");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nuevoRol = (int) $_POST['id_rol'];
    $nuevaPass = trim($_POST['password']);

    if ($nuevaPass !== '') {
        $hash = password_hash($nuevaPass, PASSWORD_DEFAULT);
        $stmt = mysqli_prepare(
            $conexion,
            "UPDATE usuarios SET id_rol = ?, `password` = ? WHERE username = ?"
        );
        mysqli_stmt_bind_param($stmt, "iss", $nuevoRol, $hash, $username);
    } else {
        $stmt = mysqli_prepare(
            $conexion,
            "UPDATE usuarios SET id_rol = ? WHERE username = ?"
        );
        mysqli_stmt_bind_param($stmt, "is", $nuevoRol, $username);
    }

    mysqli_stmt_execute($stmt);
    header("Location: listar.php");
    exit;
}

include("../../includes/header.php");
include("../../includes/menu.php");
?>

<div class="content">

    <h2>Editar usuario</h2>

    <p>
        <b>Usuario:</b> <?= htmlspecialchars($usuario['username']) ?><br>
        <b>Empleado:</b> <?= htmlspecialchars($usuario['nombre1'] . " " . $usuario['apellido1']) ?>
    </p>

    <form method="POST" style="max-width:420px;">

        <label>Rol</label><br>
        <select name="id_rol" required>
            <?php while ($r = mysqli_fetch_assoc($roles)): ?>
                <option value="<?= $r['id_rol'] ?>"
                    <?= $r['id_rol'] == $usuario['id_rol'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($r['nombre']) ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>

        <label>Nueva contraseña (opcional)</label><br>
        <input type="password"
               name="password"
               placeholder="Dejar vacío para no cambiar"><br><br>

        <button type="submit"
                style="padding:8px 14px; background:#0d6efd; color:#fff;
                       border:none; border-radius:5px; cursor:pointer;">
            Guardar cambios
        </button>

        <a href="listar.php"
           style="margin-left:10px; text-decoration:none; color:#555;">
            Cancelar
        </a>

    </form>

</div>

<?php include("../../includes/footer.php"); ?>
