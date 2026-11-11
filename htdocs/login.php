<?php
    
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once __DIR__ . "/config/conexion.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
   
    $usuario = $_POST['usuario'] ?? '';
    $clave   = $_POST['clave'] ?? '';

    $sql = "SELECT * FROM usuarios WHERE username = ?";

    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "s", $usuario);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if ($resultado && mysqli_num_rows($resultado) === 1) {

        $fila = mysqli_fetch_assoc($resultado);

        // VALIDACIÓN CORRECTA CON HASH
        if (password_verify($clave, $fila['password'])) {

            $_SESSION['usuario'] = $fila['username'];
            $_SESSION['rol']     = $fila['id_rol'];

            header("Location: dashboard.php");
            exit;
        }
    }

    $error = "Usuario o contraseña incorrectos";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Login | SyncroTech</title>

<style>
*{
    box-sizing:border-box;
    font-family:"Segoe UI",Tahoma,sans-serif;
}
body{
    margin:0;
    height:100vh;
    background:linear-gradient(135deg,#0f2027,#203a43,#2c5364);
    display:flex;
    justify-content:center;
    align-items:center;
}
.login-card{
    width:100%;
    max-width:390px;
    padding:30px;
    border-radius:14px;
    background:rgba(255,255,255,0.95);
    box-shadow:0 15px 35px rgba(0,0,0,0.35);
}
.logo{
    text-align:center;
    margin-bottom:18px;
}
.logo img{
    max-width:270px;
    width:100%;
}
.login-card h2{
    text-align:center;
    margin-bottom:25px;
}
.input-group{
    margin-bottom:15px;
}
.input-group input{
    width:100%;
    padding:12px;
    border:1px solid #ccc;
    border-radius:8px;
}
button{
    width:100%;
    padding:12px;
    border:none;
    border-radius:8px;
    background:#2c5364;
    color:#fff;
    font-size:16px;
    cursor:pointer;
}
.error{
    background:#ffe5e5;
    color:#a70000;
    padding:10px;
    border-radius:6px;
    margin-bottom:15px;
    text-align:center;
}
.footer-text{
    margin-top:20px;
    text-align:center;
    font-size:12px;
    color:#777;
}
</style>
</head>

<body>

<div class="login-card">

    <div class="logo">
        <img src="assets/img/log/Designer.png" alt="Syncrotech">
    </div>

    <h2>Iniciar Sesión</h2>

    <?php if (isset($error)): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="input-group">
            <input type="text" name="usuario" placeholder="Usuario" required>
        </div>

        <div class="input-group">
            <input type="password" name="clave" placeholder="Contraseña" required>
        </div>

        <button type="submit">Entrar</button>
    </form>

    <div class="footer-text">
        © Syncrotech Manager
    </div>

</div>

</body>
</html>




