<?php
session_start();
$racine = "../";

/**
 * Creates the user profil modification form page.
 */

use  \model\UserDao;

require_once $racine . "model/UserDao.php";

$titre = "Modify your profile";

include($racine . 'templates/html/header.php');

if (!isset($_SESSION["user_id"])) header("Location: login");
$user_dao = new UserDao();
$user = $user_dao->selectById($_SESSION["user_id"]);
include($racine . 'templates/html/userFormPage.php');
include($racine . 'templates/html/footer.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('Erreur CSRF : token invalide.');
    }
    
    $nom = htmlspecialchars($_POST['name']);
    $prenom = htmlspecialchars($_POST['firstname']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $password_confirm = htmlspecialchars($_POST['password_confirmation']);
    $tel = htmlspecialchars($_POST['tel']);

    if ($password == $password_confirm) {
        if ($user_dao->getByEmail($email) && $user_dao->update(new model\User($_SESSION['user_id'], $email, $tel, $nom, $prenom, password_hash($password, PASSWORD_DEFAULT), new \model\Role(2, "User")))) {
            header("Location: dashboard");
        } else {
            $errorMessage = "Error during signup";
            include($racine . 'templates/html/error.php');
        }
    } else {
        $errorMessage = "password not confirmed";
        include($racine . 'templates/html/error.php');
    }
}