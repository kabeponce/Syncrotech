<?php
require_once "../../includes/auth.php";
require_once "../../includes/roles.php";
soloAdmin();
require_once "../../config/conexion.php";

include("../../includes/header.php");
include("../../includes/menu.php");

$usuarios = mysqli_query(
    $conexion,
    "
    SELECT 
        u.username,
        r.nombre AS rol,
        e.nombre1,
        e.apellido1
    FROM usuarios u
    INNER JOIN empleados e ON u.id_empleado = e.id_empleado
    INNER JOIN roles r ON u.id_rol = r.id_rol
    ORDER BY e.nombre1
    "
);
?>

<div class="content">

    <h2>Usuarios del sistema</h2>

    <div style="margin:15px 0;">
        <a href="agregar.php"
           style="padding:10px 16px; background:#0d6efd; color:#fff;
                  text-decoration:none; border-radius:6px; font-weight:600;">
           ➕ Nuevo usuario
        </a>
    </div>

    <table border="1" cellpadding="10" cellspacing="0"
           style="width:100%; border-collapse:collapse;">
        <tr style="background:#0d6efd; color:#fff;">
            <th>Usuario</th>
            <th>Empleado</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>

        <?php while ($u = mysqli_fetch_assoc($usuarios)): ?>
        <tr>
            <td><?= htmlspecialchars($u['username']) ?></td>
            <td><?= htmlspecialchars($u['nombre1'].' '.$u['apellido1']) ?></td>
            <td><?= htmlspecialchars($u['rol']) ?></td>
            <td>

                <a href="editar.php?user=<?= urlencode($u['username']) ?>"
                   style="padding:6px 10px; background:#ffc107; color:#000;
                          text-decoration:none; border-radius:4px; margin-right:6px;">
                   ✏️ Editar
                </a>

                <?php if (
                    $_SESSION['usuario'] !== $u['username'] &&
                    $u['rol'] !== 'Administrador'
                ): ?>
                    <a href="eliminar.php?user=<?= urlencode($u['username']) ?>"
                       onclick="return confirm('¿Seguro que deseas eliminar este usuario?');"
                       style="padding:6px 10px; background:#dc3545; color:#fff;
                              text-decoration:none; border-radius:4px;">
                       🗑 Eliminar
                    </a>
                <?php endif; ?>

            </td>
        </tr>
        <?php endwhile; ?>
    </table>

</div>

<?php include("../../includes/footer.php"); ?>