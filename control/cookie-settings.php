<?php

/**
 * Creates the cookie-settings page (to choose the cookies you want).
 */

$racine = "../";
$titre = "Cookies";

include($racine."templates/html/header.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('Erreur CSRF : token invalide.');
    }
    $selectedColor = 'teal';
    if (isset($_POST['storeColorPreference']) && $_POST['storeColorPreference'] == "1") {
        setcookie('bg_color', $selectedColor, time() + (365 * 24 * 60 * 60), "/");
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit;
    }
}

include($racine."templates/html/cookie-settings.php");
include($racine."templates/html/footer.php");