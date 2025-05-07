# Cahier des Charges

# Titre du site : LeBonTroqueur

## Détails

Ce site a été réalisé dans le cadre de l'UE web en deuxième année de licence informatique à Avignon Université.

Voir le fichier authors.txt (non push dans github) pour voir le nom et prénom des élèves auteurs de ce projet.

Voir le fichier .env (non push dans github) pour les variables d'environnement.

## Description

Un site d'achat et ventes entre utilisateurs.

Un utilisateur peut créer un compte (nom, prénom, zone, numéro de téléphone, email), se connecter (login), ajouter des annonces (Image, une description, un nom, prix en euros) et voir des annonces (sont en plus visibles la zone et la fiche du vendeur pour contact).

Chaque produit/annonce est modifiable, supprimable. L'utilisateur peut supprimer et modifier son compte.

Le site présente une page d'accueil dynamique où sont visibles les annonces en cours (titre et image) après la présentation du site.
Quand on clique sur une annonce, ça envoie vers une page dynamique qui présente l'annonce (description, etc) et donne le contact du vendeur.

Il y a une fiche contact (objet et message) pour les administrateurs pour signaler un problème, celà envoie un mail aux administrateurs.

Pour les utilisateurs, il existe une page pour voir son compte et une pour ses annonces (après avoir login).

Pour les administrateurs, ils ont accès à un tableau de bord dédié qui leur permet de gérer les utilisateurs (suppression, modifier) et gérer les annonces (modifier, supprimer). Les administrateurs peuvent modifier, ajouter ou supprimer les questions de la FAQ.
Les administrateurs ont aussi accès à une page de faq.