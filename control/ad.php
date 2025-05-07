<?php

use model\UserDao;
use model\AdDao;
use model\ImageDao;

/**
 * Creates the advertisement page.
 */

$racine = '../';
$titre = "Product page : ";

require_once $racine.'model/AdDao.php';
require_once $racine.'model/UserDao.php';
require_once $racine.'model/ImageDao.php';

include($racine . 'templates/html/header.php');

if (!isset($_SESSION['user_id']) || !isset($_GET)) header('Location: index.php');

$ad = (new AdDao())->selectById($_GET['id']);
$user = (new UserDao())->selectById($ad->id_user);
$images = (new ImageDao())->getByAnnonceId($_GET['id']);

include($racine . 'templates/html/adPage.php');

include($racine . 'templates/html/footer.php');