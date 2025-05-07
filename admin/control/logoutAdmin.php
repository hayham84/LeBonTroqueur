<?php

/**
 * Script de déconnexion de l'administration
 *
 * Ce script détruit la session en cours afin de déconnecter l'utilisateur,
 * puis redirige vers la page d'accueil de l'administration.
 *
 */

session_start();
session_destroy();
header('Location: https://pedago.univ-avignon.fr/~uapv2401255/admin/homeAdmin');