<?php

/**
 * Creates the advertisement creation/modification form page.
 */

$racine = "../";
$titre = "Modify or create an ad";

require_once $racine . "model/AdDao.php";
require_once $racine . "model/Ad.php";
require_once $racine . "model/Image.php";
require_once $racine . "model/ImageDao.php";

include $racine . "templates/html/header.php";

if (!isset($_SESSION['user_id'])) header("Location: {$racine}index.php");

$adDao = new \model\AdDao();
$imageDao = new \model\ImageDao();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('Erreur CSRF : token invalide.');
    }
    
    $title = $_POST['title'];
    $description = $_POST['desc'];
    $location = $_POST['location'];
    $price = $_POST['price'];
    $user_id = $_POST['user_id'];
    if ($user_id != $_SESSION['user_id']) {
        header("Location: {$racine}index.php");
    }
    $result = false;
    $id_annonce = $_POST['ad_id'];

    if ($id_annonce != 0 ) { // update
        $result = $adDao->update(new \model\Ad($id_annonce, $title, $description, $location, $price, $user_id));
    } else { // creation
        $ad = new \model\Ad($id_annonce, $title, $location, $description, $price, $user_id);
        $result = $adDao->insert($ad);
        $id_annonce = $ad->id;
    }

    if (isset($_FILES['image'])) {
        $rawDir = $racine."images/ads/";
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
   header("Location: index.php");
}

include $racine . "templates/html/adFormPage.php";
include $racine . "templates/html/footer.php";
