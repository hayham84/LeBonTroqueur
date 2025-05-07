<?php

use model\ImageDao;
use model\UserDao;

/**
 * Creates the user's dashboard page.
 */

$racine = '../';

require_once $racine."model/UserDao.php";
require_once $racine.'model/AdDao.php';
require_once $racine.'model/ImageDao.php';

$titre = "Dashboard";
include($racine . 'templates/html/header.php');

if (isset($_SESSION["user_id"])){
    $user_dao = new UserDao();
    $user = $user_dao->selectById($_SESSION["user_id"]);
    include($racine . 'templates/html/dashboardPage.php');
    include($racine . 'templates/html/userAds.php');
    $ads = (new \model\AdDao())->selectAllByUser($_SESSION["user_id"]);
    foreach ($ads as $ad) {
        $images = (new ImageDao())->getByAnnonceId($ad->id);
        include($racine . 'templates/html/adCard.php');
    }
    echo "</div></div>";
} else {
    header('Location: login');
}
include($racine . 'templates/html/footer.php');