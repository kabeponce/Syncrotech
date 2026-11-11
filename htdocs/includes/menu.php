<!-- Menu lateral tomado de la plantilla Simple Sidebar. -->
<div class="border-end bg-white" id="sidebar-wrapper">
    <div class="sidebar-heading border-bottom bg-light">
        SyncroTech
    </div>

    <!-- Cada enlace del menu usa clases de Bootstrap para verse como lista lateral. -->
    <div class="list-group list-group-flush">

        <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/dashboard.php">Dashboard</a>

        <!-- Este bloque solo se muestra para Administrativo y Comercial. -->
        <?php if (in_array($_SESSION['rol'], [1, 3])): ?>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/modules/clientes/listar.php">Clientes</a>
        <?php endif; ?>

        <!-- Este bloque solo se muestra al rol Administrativo. -->
        <?php if ($_SESSION['rol'] == 1): ?>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/modules/empleados/listar.php">Empleados</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/modules/usuarios/listar.php">Usuarios</a>
        <?php endif; ?>

        <!-- Modulos comerciales: clientes, contratos, facturas, proyectos y licencias. -->
        <?php if (in_array($_SESSION['rol'], [1, 3])): ?>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/modules/contratos/listar.php">Contratos</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/modules/facturas/listar.php">Facturas</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/modules/proyectos/listar.php">Proyectos</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/modules/licencias/listar.php">Licencias</a>
        <?php endif; ?>

        <!-- Modulos de soporte u operaciones: incidencias y servicios. -->
        <?php if (in_array($_SESSION['rol'], [1, 2])): ?>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/modules/incidencias/listar.php">Incidencias</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="/modules/servicios/listar.php">Servicios</a>
        <?php endif; ?>

    </div>
</div>

<!-- Area derecha de la plantilla -->
<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <div class="container-fluid">
            <a href="/dashboard.php" class="btn btn-primary">Menu</a>

            <div class="ms-auto d-flex align-items-center gap-3">
                <span class="navbar-text">
                    Usuario: <?= htmlspecialchars($_SESSION['usuario']); ?>
                </span>
                <a class="btn btn-outline-danger btn-sm" href="/logout.php">Salir</a>
            </div>
        </div>
    </nav>

    <main class="container-fluid py-4">