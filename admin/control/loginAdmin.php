<?php

/**
 * Page de connexion pour l'administration
 *
 * Ce script permet aux administrateurs de se connecter.
 * Il affiche le formulaire de connexion et, en cas de soumission du formulaire,
 * vérifie les informations (email et mot de passe) via UserDao.
 *
 * Les vérifications effectuées comprennent :
 *  - La validation du token CSRF pour éviter les attaques de falsification de requête intersite.
 *  - La vérification de l'email et du mot de passe.
 *
 * En cas de connexion réussie, la session est initialisée avec les informations de l'utilisateur,
 * puis une redirection vers la page d'accueil de l'administration ("homeAdmin") est effectuée.
 *
 * Si l'utilisateur est déjà connecté (la variable $_SESSION['user_id'] est définie),
 * la page redirige immédiatement vers "homeAdmin".
 *
 */

namespace model;
$racine = '../';
require_once '../../model/UserDao.php';
use model\UserDao;

$titre = "Log in LeBonTroqueur";

if (!isset($_SESSION["user_id"])){
    include('../templates/header.php');
    include('../templates/loginAdminHtml.php');
    include('../templates/footer.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die('Erreur CSRF : token invalide.');
        }
        
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);

        $db_user = (new UserDao())->getByEmail($email);
        if (password_verify($password, $db_user->password)){
            $_SESSION['user_id'] = $db_user->id;
            $_SESSION['role_id'] = $db_user->role->id;
            session_start();
        }
        header("location: homeAdmin");
    }
}
else
{
    header("location: homeAdmin");
}?>