<?php
// roles.php
// Control de acceso por rol

if (!isset($_SESSION['rol'])) {
    header("Location: /syncrotech_manager/login.php");
    exit;
}

function soloAdmin() {
    if ($_SESSION['rol'] != 1) {
        header("Location: /syncrotech_manager/dashboard.php");
        exit;
    }
}

function adminYTecnico() {
    if (!in_array($_SESSION['rol'], [1, 2])) {
        header("Location: /syncrotech_manager/dashboard.php");
        exit;
    }
}

function adminYComercial() {
    if (!in_array($_SESSION['rol'], [1, 3])) {
        header("Location: /syncrotech_manager/dashboard.php");
        exit;
    }
}