<?php

$host = "sql103.infinityfree.com";
$user = "if0_42182264";
$pass = "Kleyderman1990";
$db   = "if0_42182264_syncrotech";

$conexion = mysqli_connect($host, $user, $pass, $db);

// 🔥 IMPORTANTE (acentos)
mysqli_set_charset($conexion, "utf8");

if (!$conexion) {
    die(mysqli_connect_error());
}

?>