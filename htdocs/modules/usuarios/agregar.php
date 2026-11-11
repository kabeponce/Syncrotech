<?php
require_once "../../includes/auth.php";
require_once "../../includes/roles.php";
soloAdmin();
require_once "../../config/conexion.php";

/*
  Solo se cargan empleados ACTIVOS
  que NO tengan ya un usuario asociado
*/
$empleados = mysqli_query(
    $conexion,
    "
    SELECT e.id_empleado, e.nombre1, e.apellido1
    FROM empleados e
    LEFT JOIN usuarios u ON e.id_empleado = u.id_empleado
    WHERE e.estado = 'Activo'
      AND u.id_empleado IS NULL
    "
);

// Cargar roles
$roles = mysqli_query($conexion,
    "SELECT id_rol, nombre FROM roles"
);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username    = trim($_POST['username']);
    $passwordRaw = $_POST['password'];
    $id_empleado = (int) $_POST['id_empleado'];
    $id_rol      = (int) $_POST['id_rol'];

    // Validación extra
    $check = mysqli_prepare($conexion,
        "SELECT id_usuario FROM usuarios WHERE id_empleado = ?"
    );
    mysqli_stmt_bind_param($check, "i", $id_empleado);
    mysqli_stmt_execute($check);
    mysqli_stmt_store_result($check);

    if (mysqli_stmt_num_rows($check) > 0) {
        $error = "Este empleado ya tiene un usuario asignado.";
    } else {

        $password = password_hash($passwordRaw, PASSWORD_DEFAULT);

        $stmt = mysqli_prepare(
            $conexion,
            "INSERT INTO usuarios (username, `password`, id_empleado, id_rol)
             VALUES (?, ?, ?, ?)"
        );
        mysqli_stmt_bind_param(
            $stmt,
            "ssii",
            $username,
            $password,
            $id_empleado,
            $id_rol
        );

        mysqli_stmt_execute($stmt);

        header("Location: listar.php");
        exit;
    }
}

include("../../includes/header.php");
include("../../includes/menu.php");
?>

<div class="content">

<h2>Nuevo usuario</h2>

<?php if (isset($error)): ?>
    <div style="
        background:#f8d7da;
        color:#842029;
        padding:10px;
        border-radius:5px;
        margin-bottom:15px;
    ">
        <?= $error ?>
    </div>
<?php endif; ?>

<form method="POST" style="
    max-width:420px;
    background:#fff;
    padding:20px;
    border-radius:8px;
">

    <label>Usuario</label><br>
    <input type="text" name="username" required
        style="width:100%; padding:8px; margin-bottom:10px;"><br>

    <label>Contraseña</label><br>
    <input type="password" name="password" required
        style="width:100%; padding:8px; margin-bottom:10px;"><br>

    <label>Empleado</label><br>
    <select name="id_empleado" required
        style="width:100%; padding:8px; margin-bottom:10px;">
        <option value="">Seleccione</option>
        <?php mysqli_data_seek($empleados, 0); ?>
        <?php while ($e = mysqli_fetch_assoc($empleados)): ?>
            <option value="<?= $e['id_empleado']; ?>">
                <?= $e['nombre1'] . " " . $e['apellido1']; ?>
            </option>
        <?php endwhile; ?>
    </select><br>

    <label>Rol</label><br>
    <select name="id_rol" required
        style="width:100%; padding:8px; margin-bottom:15px;">
        <?php mysqli_data_seek($roles, 0); ?>
        <?php while ($r = mysqli_fetch_assoc($roles)): ?>
            <option value="<?= $r['id_rol']; ?>">
                <?= $r['nombre']; ?>
            </option>
        <?php endwhile; ?>
    </select><br>

    <button type="submit"
        style="
            padding:8px 14px;
            background:#0d6efd;
            color:#fff;
            border:none;
            border-radius:5px;
            cursor:pointer;
        ">
        Crear usuario
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
