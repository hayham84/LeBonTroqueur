<?php

/**
 * Suppression d'une annonce et de ses images associées.
 *
 * Ce script permet de supprimer une annonce (identifiée par "id" dans l'URL)
 * ainsi que toutes les images associées à cette annonce.
 * Il vérifie que l'utilisateur indiqué par "idUser" dans l'URL est bien le propriétaire de l'annonce.
 *
 * Pour chaque image associée, le script supprime le fichier physique (via unlink)
 * puis supprime la référence dans la base de données via ImageDao.
 * Enfin, l'annonce est supprimée via AdDao.
 *
 * En cas d'erreur lors de la suppression d'un fichier ou d'une entrée en base,
 * un message d'erreur est enregistré dans le log.
 *
 */

use model\AdDao;
use model\ImageDao;

$racine = "../../";
require_once $racine."model/AdDao.php";
require_once $racine."model/imageDao.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $addao = new AdDao();
    if ($_GET['idUser'] == $addao->selectById($id)->id_user) {
        $imagedao = new ImageDao();
        $images = $imagedao->selectById($id);
        foreach ($images as $image) {
            unlink($image->image);
            if (!$imagedao->delete($image->id)) error_log("erreur deletion image ".$image->id);
        }
        if ($addao -> delete($id)) error_log("erreur suppression annonce ".$id);
    }
    header("location: https://pedago.univ-avignon.fr/~uapv2401255/admin/homeAdmin");
}