<?php
require_once "../../includes/auth.php";
require_once "../../includes/roles.php";
adminYComercial();
include("../../config/conexion.php");
include("../../includes/header.php");
include("../../includes/menu.php");

$busqueda = "";

if(isset($_GET['buscar'])){
    $busqueda = $_GET['buscar'];

    $sql = "SELECT * FROM clientes 
            WHERE (

            nombre1 LIKE '%$busqueda%' OR
            nombre2 LIKE '%$busqueda%' OR
            apellido1 LIKE '%$busqueda%' OR
            apellido2 LIKE '%$busqueda%' OR
            empresa LIKE '%$busqueda%' OR
            correo_electronico LIKE '%$busqueda%'

            )";
}else{

    $sql = "SELECT * FROM clientes WHERE estado='Activo'";
}

$resultado = mysqli_query($conexion,$sql);
?>

<div class="content">

<div class="card">

<h1>Clientes</h1>

<!-- ✅ BOTONES ARREGLADOS -->
<a href="agregar.php">➕ Nuevo Cliente</a>
<a href="inactivos.php">📁 Ver Inactivos</a>

<br><br>

<form method="GET">

<input type="text" name="buscar" placeholder="Buscar cliente..."
value="<?php echo $busqueda; ?>">

<button type="submit">Buscar</button>

<a href="listar.php">Limpiar</a>

</form>

<br>

<table border="1" width="100%" cellpadding="10">

<tr>
<th>ID</th>
<th>Nombre</th>
<th>Teléfono</th>
<th>Correo</th>
<th>Empresa</th>
<th>Acciones</th>
</tr>

<?php while($fila=mysqli_fetch_assoc($resultado)){ ?>

<tr>

<td><?php echo $fila['id_cliente']; ?></td>

<td>
<?php
echo $fila['nombre1']." ".
$fila['nombre2']." ".
$fila['apellido1']." ".
$fila['apellido2'];
?>
</td>

<td><?php echo $fila['telefono']; ?></td>
<td><?php echo $fila['correo_electronico']; ?></td>
<td><?php echo $fila['empresa']; ?></td>

<td>

<!-- ✅ EDITAR -->
<a href="editar.php?id=<?php echo $fila['id_cliente']; ?>">✏️</a>

<!-- ✅ ELIMINAR -->
<a href="eliminar.php?id=<?php echo $fila['id_cliente']; ?>"
onclick="return confirm('¿Desea desactivar este cliente?')">
🚫
</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</div>

<?php include("../../includes/footer.php"); ?>
