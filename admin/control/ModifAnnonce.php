<?php

/**
 * Page de création/modification d'annonce
 *
 * Ce script permet à un utilisateur connecté de créer ou modifier une annonce.
 * Le formulaire recueille les informations de l'annonce (titre, description, localisation, prix) et
 * en cas d'upload d'image, le script gère le déplacement des fichiers dans le dossier "images/ads/".
 *
 * Les actions réalisées sont les suivantes :
 * - Validation de la session utilisateur. Si l'utilisateur n'est pas connecté, il est redirigé vers la page d'accueil admin.
 * - Vérification de la correspondance de l'ID utilisateur dans l'URL et la session.
 * - Si la requête est de type POST :
 *      - Si l'ID de l'annonce (ad_id) est différent de 0, l'annonce est mise à jour.
 *      - Sinon, une nouvelle annonce est créée.
 *      - Les images uploadées sont traitées et enregistrées.
 *      - Enfin, l'utilisateur est redirigé vers "tableauUsers" après traitement.
 *
 * Le script inclut également les templates d'affichage (header, ModifAd et footer).
 *
 * @package LeBonTroqueur
 * @version 1.0
 */

$racine = "../../";
$titre = "Modify or create an ad";

require_once $racine . "model/AdDao.php";
require_once $racine . "model/Ad.php";
require_once $racine . "model/image.php";
require_once $racine . "model/imageDao.php";

#if (!isset($_SESSION['user_id'])) header("Location: tableauUsers.php");

$adDao = new \model\AdDao();
$imageDao = new \model\ImageDao();

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

    $title = $_POST['title'];
    $description = $_POST['desc'];
    $location = $_POST['location'];
    $price = $_POST['price'];
    $user_id = $_GET['idUser'];
    if ($user_id != $_SESSION['user_id']) {
        header("Location: {$racine}index.php");
    }
    $result = false;
    $id_annonce = $_POST['ad_id'];

    if ($id_annonce != 0 ) { // update
        $result = $adDao->update(new \model\Ad($id_annonce, $title, $location, $description, $price, $user_id));
    } else { // creation
        $ad = new \model\Ad($id_annonce, $title, $location, $description, $price, $user_id);
        $result = $adDao->insert($ad);
        $id_annonce = $ad->id;
    }

    if (isset($_FILES['image'])) {
        $rawDir = "https://pedago.univ-avignon.fr/~uapv2401255/images/ads/";
        if (!is_dir($rawDir)) {
            mkdir($rawDir, 0777, true);
        }

        if ($_FILES['image']['error'][0] != UPLOAD_ERR_NO_FILE) {
            foreach ($_FILES['image']['tmp_name'] as $key => $tmpFile) {
                // Vérifier qu’il n’y a pas d’erreur
                if ($_FILES['image']['error'][$key] === UPLOAD_ERR_OK) {
                    $originalName = $_FILES['image']['name'][$key];
                    $ext = pathinfo($originalName, PATHINFO_EXTENSION);
                    $newName = uniqid() . "." . $ext;
                    $destination = $rawDir . $newName;

                    if (move_uploaded_file($tmpFile, $destination)) {
                        $image = new \model\Image(0, $id_annonce, "images/ads/".$newName);
                        $imageDao->insert($image);
                    } else {
                        echo "<p>Échec du transfert de $originalName</p>";
                        $result = false;
                    }
                } else {
                    echo "<p>Erreur lors de l'upload de l'un des fichiers (code {$_FILES['image']['error'][$key]})</p>";
                    $result = false;
                }
            }
        }
    }


    if (!$result) {
        echo "Process Unsuccessful, please try again.";
    }
    header("Location: tableauUsers");
}

include "../templates/header.php";
if (!isset($_SESSION['user_id']))
{
    header("location: ../homeAdmin");
}
include "../templates/ModifAd.php";
include "../templates/footer.php";
