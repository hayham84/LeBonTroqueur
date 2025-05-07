<?php

/**
 * Page d'affichage d'une annonce (produit)
 *
 * Ce script affiche les détails d'une annonce (produit) pour l'utilisateur.
 * Les étapes du script sont les suivantes :
 * - Démarrer la session et vérifier que l'utilisateur est connecté.
 * - Vérifier que l'ID de l'annonce est fourni via GET.
 * - Récupérer l'annonce via AdDao, ainsi que l'utilisateur qui a posté l'annonce via UserDao.
 * - Récupérer les images associées à l'annonce via ImageDao.
 * - Inclure les templates (header, page d'annonce, footer) pour afficher la page complète.
 *
 * Si l'utilisateur n'est pas connecté, il est redirigé vers la page d'accueil admin.
 *
 * @package LeBonTroqueur
 * @version 1.0
 */

use model\UserDao;
use model\AdDao;
use model\ImageDao;

$racine = '../';
$titre = "Product page : ";


require_once  __DIR__ . '/../../model/AdDao.php';
require_once  __DIR__ . '/../../model/UserDao.php';
require_once  __DIR__ . '/../../model/imageDao.php';


$ad = (new AdDao())->selectById($_GET['id']);
$user = (new UserDao())->selectById($ad->id_user);
$images = (new ImageDao())->getByAnnonceId($_GET['id']);

include('../templates/header.php');

if (!isset($_SESSION['user_id']))
{
    header("location: ../../homeAdmin");
}


include('../templates/PageAnnonceHtml.php');

include('../templates/footer.php');