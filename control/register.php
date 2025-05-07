<?php
$racine = '../';

/**
 * Creates the sign-up page.
 */

require_once $racine . 'model/UserDao.php';
require_once $racine . 'model/User.php';
require_once $racine . 'model/Role.php';

$titre = "Sign Up to LeBonTroqueur";

include($racine . 'templates/html/header.php');

if (isset($_SESSION["user_id"])) header("Location: {$racine}index.php");
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
    $password_confirm = htmlspecialchars($_POST['password-confirmation']);
    $tel = htmlspecialchars($_POST['tel']);

    $user_dao = new \model\UserDao();

    if ($password == $password_confirm) {
        if (!$user_dao->getByEmail($email) && $user_dao->insert(new model\User(0, $email, $tel, $nom, $prenom, password_hash($password, PASSWORD_DEFAULT), new \model\Role(2, "User")))) {
            mail($email, "You have created an account on LeBonTroqueur.", "You have created an account with the email {$email}.\r\nYour current password is {$password}", "From: <no-reply>\r\n");
            header("Location:" . $racine . "control/login.php");
        } else {
            $errorMessage = "Error during signup";
            include($racine . 'templates/html/error.php');
        }
    } else {
        $errorMessage = "password not confirmed";
        include($racine . 'templates/html/error.php');
    }
}

