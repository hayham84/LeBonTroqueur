
<?php

/**
 * Page d'accueil de l'administrateur
 *
 * Ce script affiche la page d'accueil destinée aux administrateurs.
 * Il inclut le header, le contenu spécifique à l'accueil de l'administrateur et le footer pour constituer
 * une page complète et cohérente.
 *
 */

$racine = '../';
$titre = "Welcome at LeBonTroqueur";
include('../templates/header.php');
include('../templates/homeAdminHtml.php');
include('../templates/footer.php');