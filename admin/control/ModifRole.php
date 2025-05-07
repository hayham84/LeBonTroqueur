<?php

/**
 * Page de modification du rôle d'un utilisateur
 *
 * Ce script permet à l'administrateur de modifier le rôle d'un utilisateur.
 * Il effectue les opérations suivantes :
 * - Démarre la session et vérifie que l'utilisateur est connecté.
 * - Vérifie que l'identifiant de l'utilisateur à modifier est transmis via l'URL.
 * - Récupère les informations de l'utilisateur via UserDao.
 * - Affiche les informations de l'utilisateur ainsi que le formulaire de modification du rôle
 *   (via le template ModifRoleHtml.php).
 * - Lors de la soumission du formulaire, il met à jour le rôle de l'utilisateur en
 *   utilisant RoleDao pour obtenir l'identifiant correspondant au nouveau rôle et UserDao pour
 *   enregistrer la modification.
 *
 */


include(__DIR__ . '/../templates/header.php');

if (!isset($_SESSION['user_id']))
{
    header("Location: https://pedago.univ-avignon.fr/~uapv2401255/admin/homeAdmin");
}

require_once __DIR__ . '/../../model/UserDao.php';
use model\UserDao;
use model\RoleDao;

// Vérifier que l'ID est fourni dans l'URL
if (!isset($_GET['id'])) {
    echo "Aucun identifiant d'utilisateur fourni.";
    exit;
}

$id = intval($_GET['id']);
$userDao = new UserDao();
$RoleDao = new RoleDao();
$user = $userDao->selectById($id);
echo "<h4><span class='w3-text-teal w3-padding w3-show-block'>Modification de  $user->firstname  $user->name. </span></h4>";

include(__DIR__ . '/../templates/ModifRoleHtml.php');
?>

<script>
    function verif()
    {

        var tel = document.getElementById("tel").value;
        if (tel == '')
        {
            alert("Veuillez saisir un Role");
            return false;
        }
    }
</script>
<?php
if (isset($_POST['submit']))
{
    $user->role->role_name = isset($_POST['role'])? $_POST['role'] : $user->role->role_name;
    //echo $user->role->role_name;
    $id_role = $RoleDao->getIdRole($user->role->role_name);
    //echo $id_role;
    $user->role->id = isset($_POST['role'])?  $id_role : $user->role->role_name;
    //echo $user->role->id;
    //echo $user->role->role_name;
    $userDao->update($user);
    echo "<p class='w3-padding w3-text-green'>Changement de numéro de Role pris en compte !</p>";
}


include(__DIR__ . '/../templates/footer.php');
?>