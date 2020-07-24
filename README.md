# Convert-mysql

Ce script est un outil permettant la migration rapide de votre base de données MySQL / MariaDB d'un charset à un autre.

## A quoi sert-il ?

La norme du charset étant actuellement l'UTF-8. Cet outil sert essentiellement lors de la migration de site web. 
Il n'est pas rare de rencontrant des anciens sites internet se trouvant par exemple en latin1_swedish_ci (ou autre charset).
Ce qui peut provoquer des problèmes d'affichages avec les lettres acentuées.
Grace à ce script, vous migrez efficacement votre base MySQL/MariaDb vers un charset de type UTF-8 ou UTF-8 MB4.


## Fonctionnalités

Ce script permet de :

  * Convertir la base de données
  * Convertir les tables de votre base de données
  * Convertir les données se trouvant dans les champs de votre base de données
  * Convertir les données de types "binaires" 
  * Gère les interclassement et les collation
  * Sauvegarde de votre base de données avant d'effectuer la conversion
  * Conversion des clés d'indexations (PRI, UNI, MUL)
  * Gère les clés d'indexation extérieures
  * Optimisation des tables MyISAM
  * Détection automatique des charset présents


## Minimum requis

Ce script nécessite la présence de PHP 7.1 au minimum et une base de données MySQL / MariaDB

## Installation

Pour installer ce script, il suffit de créer un répertoire convert_mysql à la racine de votre site puis d'y copier le contenu téléchargé ici.
Ensuite, il vous suffit de mettre dans la barre URL de votre navigateur préféré l'URL suivante : http://www.votresite.com/convert_mysql/ et de suivre les instructions à l'écran.

## CHANGELOG

Version 2.00 [24/07/2020]:
  * Migration des fichiers PHP vers la version 7.2.x
  * Migration de l'interface graphique vers HTML5/CSS3
  * Prise en charge de la conversion des clés d'indexation de type unique (UNI) et index (MUL)
  * Prise en charge de la famillebcharsets utf8mb4
  * Amélioration de la gestion des clés d'indexation extérieures
  * Amélioration de la pré-conversion des champs binaires de type BINARY, BLOB, TINYBLOB, MEDIUMBLOB, LONGBLOB, VARBINARY
  * Système multilangues de l'interface (français / anglais)
  * Amélioration de la prise en charge des grosses bases de données

Version 1.01 [05/01/2013]:
  * Intégration de PDO pour l'accès à la base de données
  * Ajout de l'optimisation des tables à la fin du processus de conversion
  * Correction d'un bug lors de la sauvegarde MySQL si ZLIB est absent, maintenant si ZLIB est absent la sauvegarde sera disponible au format texte
  * Mise en place d'une pré-conversion binaire pour les champs BINARY, BLOB, TINYBLOB, MEDIUMBLOB, LONGBLOB, VARBINARY. Ceci assure une meilleure conversion du champs en cas de présence de caractères spécifiques
  * Ajout d'une meilleure gestion des clés primaires sur les tables utilisant le moteur InnoDB

Version 1.01RC [26/12/2012]:
  * Ajout du numéro de version en bas du formulaire
  * Correction d'un "warning" PHP causé par "safe_mode" lorsqu'il est activé

