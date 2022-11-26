<?php
/*
	// Fichier pour la conversion de charset d'une base de donnée MySQL
	// Auteur : Cédric MONTUY
	// Date : 07 juillet 2020
	// Version : 2.00
	// Plus de détail : https://github.com/montuy337513/convert_mysql
	// Site internet : store.chg-web.com
*/
define('TITRE','Convert-sql, le convertisseur de tables MySQL/MariaDB');
define('LANG','Français');
define('SUBMIT','Soumettre');
define('SUITE', 'La suite...');
define('BACKUP','Lancer la sauvegarde');
define('ANALYSE','Lancer les analyses');
define('CONVERSION','Lancer la conversion');
define('A_FAIRE','A faire');
define('SUCCESS','Succès');
define('CLOSE','Fermer l\'application');
define('COURS','Opération de conversion en cours ');
define('FINI','Opération de conversion terminée avec succès');
define('COMPRIS','J\'ai compris cet avertissement');
define('ADVERT','Ce script manipule les données de votre BDD, il est judicieux de faire une sauvegarde complète de votre base avant de lancer ce script.<br />Nous vous conseillons de faire un essai sur une copie de votre base de données, surtout si votre site est en production.<br />Le développeur décline toute responsabilité si vos données se retrouvent altérées ou si votre site web est HS suite à l\'utilisation de ce script.');
define('SAUVEGARDE','Procéder à une sauvegarde de la BDD');
define('USERNAME','Nom utilisateur de la base de données');
define('PWD','Mot de passe de la base de données');
define('HOST','Nom du serveur BDD');
define('DATABASE','Nom de la base de données à traiter');
define('HOST_HELP','Souvent 127.0.0.1 ou Localhost');
define('DB_COLLATION','Migrer la base de donnée vers :');
define('STRUCTURE_TABLE','Sauvegarde structure table : %s');
define('DONNEES_TABLE','Sauvegarde des données de la table : %s %d / %d');
define('RECUP_BACKUP','Télécharger la sauvegarde');
define('PROCESS','En cours...');
define('LINK_BCK','Lien de téléchargement de la sauvegarde: ');
define('TITRE_REQUETE','Tâches de conversions à effectuer');
define('TRAVAIL_REQUETE','Résumé des tâches de conversions à effectuer ( nb de requetes faite / nb de requetes totales à faire )');
define('SANS_INNO', '%s ;');
define('AVEC_INNO', 'SET foreign_key_checks = 0; %s ; SET foreign_key_checks = 1;');
define('SIGNAL_BUG','Signaler un bug / une amélioration');
define('NEWSLETTER','S\'inscrire à la newsletter pour être informé des futures mises à jours');
define('GITHUB','Compte Github de montuy337513');
define('IN','Compte LinkedIn de montuy337513');
define('LICENCE','Logiciel sous licence ');
define('SERVICE', 'Nos services et logiciels');
// Messages d'erreur
define('MESS1','Au moins un champs et vide');
define('MESS2','Merci de préciser un interclassement se trouvant dans la liste');
define('MESS3','Impossible de se connecter au serveur SQL. Merci de vérifier les valeurs de connexions');
define('MESS4','Une procédure en cours est détectée, merci de vérifier si le script n\'est pas exécuté ailleurs avant de continuer.<br />Si la procédure précédente a été abandonnée par votre choix, vous pouvez continuer. ');
define('MESS5','Impossible de supprimer les fichiers .key dans le répertoire /cache.<br />Supprimer les manuellement ou vérifier les droits en écriture sur ce répertoire.');
define('MESS6','Aucun fichier de procédure a été détecté, merci de recommencer l\'opération.');
define('MESS7','Fichier clé absent');
define('MESS8','Impossible de créer le fichier de sauvegarde temporaire');
define('MESS9','Impossible de créer les entêtes de sauvegarde');
define('MESS10','Erreur de récupération pour la sauvegarde');
define('MESS11','La collation est manquante');
define('MESS12','Table ou champs inexistant');
define('MESS13','Tâble des requêtes MySQL vide');
// Étapes différentes
define('ETP1','Étape 1 : Avertisssement');
define('ETP2','Étape 2 : Connexion à la base de données MySQL ou Maria DB');
define('ETP3','Sauvegarde de votre base de données');
define('ETP4','Analyse / conversion de votre base de données');

// Section backup
define('BCK0','Connexion à la BDD');
define('BCK1','Création du fichier temporaire');
define('BCK2','Création des entêtes');
define('BCK3','Récupération des tâbles');
define('BCK_STOP','Processus de fin de sauvegarde');
// Section convertisseur
define('CONV0','Votre base : %s');
define('CONV1','Récupération des tables de votre BDD');
define('CONV2', 'Analyse de la table %s - De %s vers %s');
define('CONV3', 'Analyse du champs %s de la table %s');
define('CONV4','Conversion de la BDD');
define('CONV5','Processus de fin d\'analyse');
define('CONV_STOP','Processus de fin de conversion');

