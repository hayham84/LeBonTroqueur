
<?php

/**
 * Page d'accès au profil de l'utilisateur et affichage de ses annonces.
 *
 * Ce script :
 * - Vérifie si l'utilisateur est connecté (via $_SESSION['user_id']).
 * - Vérifie que l'ID de l'utilisateur est fourni dans l'URL.
 * - Récupère et affiche le profil de l'utilisateur à l'aide de UserDao.
 * - Récupère et affiche toutes les annonces associées à l'utilisateur via AdDao.
 * - Pour chaque annonce, récupère et affiche les images correspondantes via ImageDao.
 *
 * Si l'utilisateur n'est pas connecté, il est redirigé vers la page d'accueil admin.
 *
 */

$racine = '../';
$titre = "Welcome at LeBonTroqueur";
include(__DIR__ . '/../templates/header.php');

require_once '../../model/AdDao.php';
require_once '../../model/UserDao.php';
require_once '../../model/imageDao.php';
use model\UserDao;
use model\AdDao;
use model\ImageDao;



if (!isset($_SESSION['user_id'])) {
    session_start();
    header("Location: https://pedago.univ-avignon.fr/~uapv2401255/admin/homeAdmin");
    exit;
}

// Vérifier que l'ID est fourni dans l'URL
if (!isset($_GET['id'])) {
    echo "Aucun identifiant d'utilisateur fourni.";
    exit;
}

$id = intval($_GET['id']);
$_GET['id'] = $id;
$userDao = new UserDao();
$user = $userDao->selectById($id);

if (!$user) {
    echo "Utilisateur non trouvé.";
    exit;
}

// Préparation des variables pour la vue
$title = "Profil de " . htmlspecialchars($user->firstname) . ' ' . htmlspecialchars($user->name);

// Inclure la vue qui affichera le HTML
include '../templates/profilehtml.php';
?>
<div class="w3-padding">
    <h4>Annonces de l'utilisateur : </h4>
</div>
<?php
$AdDao = new AdDao();
$ads = $AdDao->selectAllByUser($id);

$imageDao = new ImageDao();

if ($ads !== null) {
    foreach ($ads as $ad) {
        echo "<div class='w3-card w3-container w3-padding w3-quarter w3-round w3-margin'>";
        // On utilise getId() pour récupérer l'identifiant de l'annonce
        echo "<a href='../PageAnnonce/" . htmlspecialchars($ad->getId()) . "/" . htmlspecialchars($id) . "' class='clean-ref'><h4>" . htmlspecialchars($ad->title) . "</h4></a>";


        // Récupère l'ensemble des images de l'annonce
        $images = $imageDao->getByAnnonceId($ad->getId());
        if (!empty($images)) {
            // On affiche chaque image, la première est visible, les suivantes masquées
            foreach ($images as $index => $img) {
                $displayStyle = ($index == 0) ? 'display:block;' : 'display:none;';
                $str = $img->url;
                echo "<img src='https://pedago.univ-avignon.fr/~uapv2401251/" . $img->url . "' style='width:100%; " . $displayStyle . "' alt='small image'>";
            }
        } else {
            // Affichage d'une image par défaut en cas d'absence d'image
            echo "<img alt='small image' src='../../images/default.png' style='width:100%;'>";
        }
        echo "</div>";
    }


}


include('../templates/footer.php');
?>

