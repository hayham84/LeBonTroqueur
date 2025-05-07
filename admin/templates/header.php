<?php
session_start();
$bg_color = "teal";

if (empty($_SESSION['csrf_token'])) {
    try {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    } catch (\Random\RandomException $e) {
        error_log($e->getMessage());
    }
}

if(isset($_COOKIE['cookie_consent'])){
    if (isset($_COOKIE['bg_color']) && $_COOKIE['bg_color'] == 'red') $bg_color = "red";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LeBonTroqueur</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-red.css">

    <link rel="stylesheet"  href="../templates/css/style.css">
    <link rel="stylesheet"  href="../../templates/css/style.css">
    <link rel="stylesheet" href="https://pedago.univ-avignon.fr/~uapv2401255/admin/templates/css/faq.css">

    <link rel="stylesheet"  href="../templates/css/cookies.css">
    <link rel="stylesheet"  href="https://pedago.univ-avignon.fr/~uapv2401255/admin/templates/css/cookies.css">
    <link rel="icon" type="image/x-icon" href="https://pedago.univ-avignon.fr/~uapv2401255/images/website/logo.png">
    <link rel="icon" type="image/x-icon" href="https://pedago.univ-avignon.fr/~uapv2401255/../../images/website/logo.png">
    <script src="https://pedago.univ-avignon.fr/~uapv2401255/admin/templates/cookies.js"></script>

</head>
<body style="background-color: #F5F5F5;">

<header class="w3-theme-d2 w3-cell-row">
    <div class="w3-cell w3-padding w3-cell-middle half"><h1><a class="clean-ref" href="https://pedago.univ-avignon.fr/~uapv2401255/admin/homeAdmin">LeBonTroqueur</a>
        </h1></div>
    <div class="w3-cell w3-padding w3-cell-middle half align-right">
        <?php if (isset($_SESSION['user_id'])):
            if ($_SESSION['role_id'] == 1):?>
                <a href="https://pedago.univ-avignon.fr/~uapv2401255/admin/tableauUsers" class="w3-button w3-yellow">Accueil Admin</a>
            <?php endif;?>
            <a href="https://pedago.univ-avignon.fr/~uapv2401255/admin/logoutAdmin" class="w3-button w3-red">Logout</a>
        <?php else: ?>
            <a href="https://pedago.univ-avignon.fr/~uapv2401255/admin/loginAdmin" class="w3-button w3-theme">Login</a>
        <?php endif; ?>
    </div>
</header>
