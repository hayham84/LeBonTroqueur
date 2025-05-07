<?php

/**
 * Page de modification du nom et du prénom de l'utilisateur
 *
 * Ce script permet à un utilisateur connecté de modifier son nom et son prénom.
 * Il réalise les opérations suivantes :
 * - Démarre la session et vérifie que l'utilisateur est connecté.
 * - Vérifie que l'identifiant de l'utilisateur à modifier est fourni via l'URL.
 * - Récupère les informations de l'utilisateur en utilisant UserDao.
 * - Affiche une interface de modification (via le template ModifNomPrenomHtml.php).
 * - Lors de la soumission, met à jour les données de l'utilisateur dans la base de données.
 */


include(__DIR__ . '/../templates/header.php');

if (!isset($_SESSION['user_id']))
{
    header("Location: https://pedago.univ-avignon.fr/~uapv2401255/admin/homeAdmin");
}

require_once __DIR__ . '/../../model/UserDao.php';
use model\UserDao;


// Vérifier que l'ID est fourni dans l'URL
if (!isset($_GET['id'])) {
    echo "Aucun identifiant d'utilisateur fourni.";
    exit;
}

$id = intval($_GET['id']);
$userDao = new UserDao();
$user = $userDao->selectById($id);
echo "<h4><span class='w3-text-teal w3-padding w3-show-block'>Modification de  $user->firstname  $user->name. </span></h4>";

include(__DIR__ . '/../templates/ModifNomPrenomHtml.php');
?>
<script>
    function verif()
    {

        var nom = document.getElementById("name").value;
        var prenom = document.getElementById("firstname").value;
        if (nom == '' && prenom =='')
        {
            alert("Veuillez saisir un nom et prenom de tel");
            return false;
        }
    }
</script>

<?php
if (isset($_POST['submit']))
{
    $user->name = isset($_POST['name'])? $_POST['name'] : $user->name;
    $user->firstname = isset($_POST['firstname'])? $_POST['firstname'] : $user->firstname;
    $userDao->update($user);
    echo "<p class='w3-padding w3-text-green'>Changement pris en compte !</p>";
}


include(__DIR__ . '/../templates/footer.php');
?>