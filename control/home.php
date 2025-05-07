<?php
$racine = '../';
require_once $racine . 'model/AdDao.php';
require_once $racine . 'model/Image.php';
require_once $racine . 'model/ImageDao.php';
use model\AdDao;
use model\Image;
use model\ImageDao;

/**
 * Creates the home page.
 */

$titre = "Welcome at LeBonTroqueur";
include($racine . 'templates/html/header.php');

require_once $racine . 'model/AdDao.php';
require_once $racine . 'model/ImageDao.php';

if (isset($_SESSION["user_id"])) {
    $ads = (new AdDao())->selectAll();
    include($racine . 'templates/html/homePageConnected.php');
    foreach ($ads as $ad) {
        $images = (new ImageDao())->getByAnnonceId($ad->id);
        include($racine . 'templates/html/adCard.php');
    }
    echo "</div></div>";
} else {
    include($racine . 'templates/html/homePageNotConnected.php');
}
include($racine . 'templates/html/footer.php');