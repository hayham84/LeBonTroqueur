<?php

/**
 * Page de gestion des préférences de cookies
 *
 * Ce script permet à un utilisateur connecté de définir ses préférences de cookies.
 * Dans cet exemple, on enregistre la couleur de fond (bg_color) via un cookie.
 *
 * Fonctionnement :
 * - Si l'utilisateur n'est pas connecté, il est redirigé vers la page d'accueil admin.
 * - Le script inclut le header, le formulaire de gestion des cookies (via ParametreCookiesHtml.php)
 *   et le footer.
 * - Lors de la soumission du formulaire en POST, le token CSRF est vérifié.
 * - Si la préférence (storeColorPreference) est validée, un cookie 'bg_color' est créé avec la valeur 'teal'
 *   pour une durée d'un an, puis la page est rechargée.
 *
 */

if (empty($_SESSION["user_id"]))
{
    header("location: https://pedago.univ-avignon.fr/~uapv2401255/admin/homeAdmin");
}
$racine = "../";
$titre = "Cookies";

include('../templates/header.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token'])
    {
        die('Erreur CSRF : token invalide.');
    }
    $selectedColor = 'teal';
    if (isset($_POST['storeColorPreference']) && $_POST['storeColorPreference'] == "1") {
        setcookie('bg_color', $selectedColor, time() + (365 * 24 * 60 * 60), "/");
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit;
    }
}

include($racine."templates/ParametreCookiesHtml.php");
include('../templates/footer.php');