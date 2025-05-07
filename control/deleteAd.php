<?php
session_start();
use model\AdDao;
use model\ImageDao;

/**
 * Php control file to delete an advertisement.
 */

$racine = "../";
require_once $racine."model/AdDao.php";
require_once $racine."model/ImageDao.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $addao = new AdDao();
    if ($_SESSION['user_id'] == $addao->selectById($id)->id_user) {
        $imagedao = new ImageDao();
        $images = $imagedao->selectById($id);
        foreach ($images as $image) {
            unlink($image->image);
            if (!$imagedao->delete($image->id)) error_log("erreur deletion image ".$image->id);
        }
        if ($addao -> delete($id)) error_log("erreur suppression annonce ".$id);
    }
    header("location: index.php");
}