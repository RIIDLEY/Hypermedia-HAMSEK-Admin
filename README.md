# Hypermedia de Lahoucine HAMSEK
***

L'objectif de ce projet est de réaliser différentes briques de codes récurrentes dans la création d'un outil hypermedia.
Chacune de ces briques est ajoutée au fur et à mesure de l'avancée du projet afin de réaliser un GED (Gestionnaire électronique des documents).

## Technologies utilisés

Utilisation d'un design pattern MVC avec le langage PHP.  
Une Base de Données sous MySQL est utilisé pour stocker les données.  
J'ai utilisé WAMP pour travailler sur ce projet.  

## Comment l'installer

Il faut créer un nouvelle utilisateur MySQL/MariaDB avec comme login : "hypermedia-hamsek" et comme mot de passe : "@x/t3F4chrzpwQDY"  
Par la suite lancez le script SQL DB.sql qui se trouve dans le dossier Utils.  
Il permet de créer la base de données ainsi que la table nécessaire.  
Ensuite vous pouvez mettre le dossier contenant le site dans votre dossier qui permet de le lancer avec Apache.  
Allez sur votre navigateur Web, puis à l'adresse localhost/Hypermedia-HAMSEK pour avoir accès au systeme que j'ai réalisé.  

## Brique 1 : Pagination

Un système de pagination a été installé afin de naviguer entre les images présentes sur le serveur. Ce système permet d'affiche 4 images par page.

## Brique 2 : Upload

Un utilisateur a la possibilité de téléverser une image. Cette image sera ensuite téléversée vers le dossier de stockage du serveur et référencée sur la base de données.
Une image ne peut pas être téléversé plus d'une fois.

## Brique 3 : Lecture Récursive

Un bouton "Scan" est présent sur le site web. Il permet de lire l’ensemble des images dans le dossier et sous dossiers possibles.
Ces images sont ensuite téléversées vers le dossier de stockage du serveur et référencées sur la base de données.

## Identifiant/mot de passe

Pour la base de données
* Login : hypermedia-hamsek
* Mot de passe : @x/t3F4chrzpwQDY
