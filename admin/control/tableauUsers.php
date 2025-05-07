<link rel='stylesheet' href='../templates/css/faq.css'>
<?php

/**
 * Page d'affichage des utilisateurs
 *
 * Ce script affiche un tableau récapitulatif de tous les utilisateurs de l'application.
 * Il effectue les opérations suivantes :
 * - Définit les variables nécessaires pour la page (racine, titre).
 * - Démarre la session et vérifie si l'utilisateur est connecté (via $_SESSION['user_id']).
 * - Inclut le header.
 * - Utilise UserDao pour récupérer l'ensemble des utilisateurs.
 * - Si l'utilisateur n'est pas connecté, il est redirigé vers la page homeAdmin.
 * - Sinon, le script inclut le template du tableau des utilisateurs ainsi que le footer.
 *
 */

$racine = '../';
$titre = "Welcome at LeBonTroqueur";
include('../templates/header.php');

require_once __DIR__ . '/../../model/UserDao.php';
use model\UserDao;

$userDao = new UserDao();
$users = $userDao->selectAll();


if (!isset($_SESSION['user_id']))
{
    header("location: homeAdmin");
} else {
    //var_dump($users);

    include('../templates/tableauUsersHtml.php');
    include('../templates/footer.php');
}
?>

