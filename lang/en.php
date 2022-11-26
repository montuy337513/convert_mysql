<?php
/*
	/// Fichier pour la conversion de charset d'une base de donnée MySQL
	// Auteur : Cédric MONTUY
	// Date : 07 juillet 2020
	// Version : 2.00
	// Plus de détail : https://github.com/montuy337513/convert_mysql
	// Site internet : store.chg-web.com
*/
define('TITRE','Convert-sql, the MySQL / MariaDB table converter');
define('LANG','English');
define('SUBMIT','Submit');
define('SUITE', 'The following...');
define('BACKUP','Start backup');
define('ANALYSE','Start analyzes');
define('CONVERSION','Start conversion');
define('A_FAIRE','Waiting');
define('SUCCESS','Success');
define('CLOSE','Close');
define('COURS','Conversion operation in progress ');
define('FINI','Conversion operation completed successfully');
define('COMPRIS','I understood this warning');
define('ADVERT','This script handles the data of your database, it is a good idea to make a full backup of your database before running this script.<br />We recommend that you test a copy of your database, especially if your site is in production.<br />The developer declines all responsibility if your data is corrupted or if your website is down as a result of using this script.');
define('SAUVEGARDE','Perform a backup of the database');
define('USERNAME','Database username');
define('PWD','Database password');
define('HOST','Database server name (host)');
define('DATABASE','Database name');
define('HOST_HELP','Often 127.0.0.1 or Localhost');
define('DB_COLLATION','Migrate the database to :');
define('STRUCTURE_TABLE','Save table structure : %s');
define('DONNEES_TABLE','Save data of table : %s %d / %d');
define('RECUP_BACKUP','Download the backup');
define('PROCESS','In progress...');
define('LINK_BCK','Backup download link : ');
define('TITRE_REQUETE','Conversion tasks to perform');
define('TRAVAIL_REQUETE','Summary of conversion tasks to perform ( number of requests made / number of total requests to be made )');
define('SANS_INNO', '%s ;');
define('AVEC_INNO', 'SET foreign_key_checks = 0; %s ; SET foreign_key_checks = 1;');
define('SIGNAL_BUG','Report a bug / improvement');
define('NEWSLETTER','Subscribe to the newsletter to be informed of future updates');
define('GITHUB','Github account of montuy337513');
define('IN','LinkedIn account of montuy337513');
define('LICENCE','Licence ');
define('SERVICE', 'Our services and software');
// Messages d'erreur
define('MESS1','At least one field and empty');
define('MESS2','Please specify an interclassing found in the list');
define('MESS3','Unable to connect to SQL server. Please check the connection values.');
define('MESS4','A procedure in progress is detected, please check if the script is not executed elsewhere before continuing.<br />If the previous procedure was abandoned by your choice, you can continue. ');
define('MESS5','Unable to delete files .key in the repertory /cache.<br />Manually delete them or check write permissions on this directory.');
define('MESS6','No procedure file was detected, please try again.');
define('MESS7','File .key is missing');
define('MESS8','Unable to create temporary backup file');
define('MESS9','Impossible de créer les entêtes de sauvegarde');
define('MESS10','Recovery error for backup');
define('MESS11','The collation is missing');
define('MESS12','Table ou field is missing');
define('MESS13','MySQL query table is missing');
// Étapes différentes
define('ETP1','Étape 1 : Warning');
define('ETP2','Étape 2 : Connection to the MySQL or Maria DB database');
define('ETP3','Backup your database');
define('ETP4','Analyze / conversion of your database');

// Section backup
define('BCK0','Connection to the database');
define('BCK1','Creation of the temporary file');
define('BCK2','Creation of headers');
define('BCK3','Recovery of the tables');
define('BCK_STOP','End of backup process');
// Section convertisseur
define('CONV0','Your basename : %s');
define('CONV1','Retrieving tables from your database BDD');
define('CONV2', 'Analysis of the table %s - From %s to %s');
define('CONV3', 'Analysis of field %s of %s table');
define('CONV4','Database conversion');
define('CONV5','End of analysis process');
define('CONV_STOP','End of conversion process');

