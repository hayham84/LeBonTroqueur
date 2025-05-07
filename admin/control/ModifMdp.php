<?php

/**
 * Page de modification du mot de passe pour l'administration
 *
 * Ce script permet à un administrateur de modifier le mot de passe d'un utilisateur.
 * Il effectue les opérations suivantes :
 * - Démarre ou vérifie la session.
 * - Vérifie que l'utilisateur est connecté.
 * - Vérifie que l'identifiant de l'utilisateur à modifier est passé via GET.
 * - Récupère les informations de l'utilisateur via UserDao.
 * - Affiche un formulaire de modification (via un template).
 * - Une fois le formulaire soumis, compare les deux saisies de mot de passe.
 * - Si validé, le nouveau mot de passe est hashé et l'utilisateur est mis à jour dans la base.
 *

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

include(__DIR__ . '/../templates/ModifMdpHtml.php');
?>
<script>
    function verif()
    {

        var pass1 = document.getElementById("password").value;
        var pass2 = document.getElementById("password-confirmation").value;
        if (pass1 != pass2)
        {
            alert("Veuillez saisir le même mot de passe");
            return false;
        }
    }
</script>
<?php
if (isset($_POST['submit']))
{
    $user->password = isset($_POST['password'])? password_hash($_POST['password'], PASSWORD_DEFAULT) : $user->password;
    $userDao->update($user);
    echo "<p class='w3-padding w3-text-green'>Changement de Mot de passe pris en compte !</p>";
}


include(__DIR__ . '/../templates/footer.php');
?>
