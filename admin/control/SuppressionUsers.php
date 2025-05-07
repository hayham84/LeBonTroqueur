<?php

/**
 * Page de suppression d'un utilisateur
 *
 * Ce script permet de supprimer un utilisateur de la base de données.
 * Il effectue les opérations suivantes :
 *  - Vérifie que l'identifiant de l'utilisateur est fourni via l'URL.
 *  - Utilise UserDao pour supprimer l'utilisateur correspondant.
 *  - Affiche un message indiquant que la suppression a été prise en compte.
 *
 * Après la suppression, le script inclut le header et le footer pour afficher la page complète.
 *
 */

$racine = '../';
$titre = "Welcome at LeBonTroqueur";
include(__DIR__ . '/../templates/header.php');

require_once __DIR__ . '/../../model/UserDao.php';
use model\UserDao;


// Vérifier que l'ID est fourni dans l'URL
if (!isset($_GET['id'])) {
    echo "Aucun identifiant d'utilisateur fourni.";
    exit;
}

$id = intval($_GET['id']);
$userDao = new UserDao();
echo "<p class='w3-padding w3-text-green'>Suppression pris en compte !</p>";
$userDao->delete($id);



include(__DIR__ . '/../templates/footer.php');
?>