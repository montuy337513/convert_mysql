<?php
/*
        // Fichier pour la conversion de charset d'une base de donnée MySQL
	// Auteur : Cédric MONTUY
	// Date : 27 novembre 2022
	// Version : 3.00
	// Plus de détail : https://github.com/montuy337513/convert_mysql
	// Site internet : store.chg-web.com
*/

// Initialisation du script
if (!ini_get('safe_mode')) {
	set_time_limit(0);
}
if (version_compare(PHP_VERSION,'7.1.0', '<')) {
	die ('Version 7.1.0 de PHP requis');
}
if(!class_exists('PDO')) {
    die('Class PDO manquante, merci d\'activer la class PDO dans votre version de PHP');
}
session_start();
// Paramètres et variables par défaut
$content = '';
$op = 1;
$sauvegarde = '';
$username = '';
$password = '';
$database = '';
$host = 'localhost';
$db_collation = 'utf8_general_ci';
$version = '3.00';
$debug_smarty = false;
$langue = '';
$langue_defaut = 'fr';
$ok='';
$message='';
$cle = '';
$tache_js = '';
$limite = 1; // Limite en Mo pour scinder les requetes
$backup_etape = array();
$convert_etape = array();

require __DIR__.'/inc/liste_interclassement.php';
$entree = array(
    'op' => 'int',
    'sauvegarde' => 'string',
    'db_collation' => 'string',
    'username' => 'string',
    'password' => 'string',
    'database' => 'string',
    'host' => 'string',
    'langue' => 'string',
    'ok' => 'string',
    'cle' => 'string'
);
// Appel du fichier de fonctions
require __DIR__.'/inc/functions.php';
// Détection de l'URL
$temp = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME'];
$url = str_ireplace('/index.php','',$temp);
// Appel de Smarty
require __DIR__.'/inc/smarty/Autoloader.php';
// Lancement de Smarty
$smarty = new Smarty();
$smarty->setTemplateDir(__DIR__.'/tpl/');
$smarty->setCompileDir(__DIR__.'/templates_c/');
$smarty->setConfigDir(__DIR__.'/configs/');
$smarty->setCacheDir(__DIR__.'/cache/');
$smarty->debugging = $debug_smarty;

// Filtrage des variables d'entrée
foreach($entree as $k => $v){
    if(array_key_exists($k,$_POST)){
        switch ($v) {
            case'int':
                $type = FILTER_SANITIZE_NUMBER_INT;
                break;
            case'string';
            default:
                $type = FILTER_SANITIZE_STRING;
        }
        $$k = filter_input(INPUT_POST,$k,$type);
    }
}

// Gestion de la langue
if (!array_key_exists('langue',$_SESSION)){
    $_SESSION['langue'] = $langue_defaut;
}else{
    if (!empty($langue)){
        $_SESSION['langue'] = $langue;
    }
}    
if(!is_file(__DIR__.'/lang/'.$_SESSION['langue'].'.php')){
    $langue = $langue_defaut;
    $_SESSION['langue'] = $langue_defaut;
}else{
    $langue = $_SESSION['langue'];
}  
require __DIR__.'/lang/'.$langue.'.php';
// Traitement des données
switch($op){
    case'2':
        if($ok != 'on'){
            $op = '1';
        }else{
            $liste_fichier = scandir(__DIR__.'/cache/');
            $liste_cle = array_filter($liste_fichier,'test_cle');
            if(count($liste_cle) > 0 ){
                foreach ($liste_cle as $value) {
                    if(unlink(__DIR__.'/cache/'.$value) === false){
                        $message .= MESS5;
                    }
                }
            }
            $liste_conf = array_filter($liste_fichier,'test_conf');
            if(count($liste_conf) > 0 ){
                foreach ($liste_conf as $value) {
                    if(unlink(__DIR__.'/cache/'.$value) === false){
                        $message .= MESS5;
                    }
                }
            }
            $liste_tache = array_filter($liste_fichier,'test_tache');
            if(count($liste_tache) > 0 ){
                foreach ($liste_tache as $value) {
                    if(unlink(__DIR__.'/cache/'.$value) === false){
                        $message .= MESS5;
                    }
                }
            }
            unset($liste_fichier,$liste_cle,$liste_conf,$liste_tache);
            $cle = uniqid();
            file_put_contents(__DIR__.'/cache/'.$cle.'.key', '');
        }
        break;
    case'3':
        if(empty($database) OR empty($username) OR empty($host) OR empty($db_collation)){
            $op = '2';
            $message .= MESS1;
        }elseif(!in_array($db_collation,$table_interclassement)){
            $op = '2';
            $message .= MESS2;
        }elseif(empty($cle) OR !is_file(__DIR__.'/cache/'.$cle.'.key')){
            $message .= MESS6;
            $op = '1';
        }else{
            $dsn = 'mysql:host='.$host.';charset=UTF8;dbname='.$database;
            try {
                $sql = new PDO($dsn, $username, $password,array());
            } catch (PDOException $e) {
                $message .= MESS3;
                $message .= '<p>ERREUR ! : '.utf8_encode($e->getMessage()).'</p>';
                $op = '2';
            }
        }
        if (empty($message)){
            if(empty($sauvegarde)){
                $op ='4';
            }
            file_put_contents(__DIR__.'/cache/'.$cle.'.key', strrev($password));
            //Récupération de la liste des tables
            $requete = $sql->query('SELECT TABLE_NAME, ROUND(((DATA_LENGTH + INDEX_LENGTH - DATA_FREE) / 1024 / 1024), 2) AS TailleMo FROM information_schema.TABLES WHERE TABLE_SCHEMA = \''.$database.'\'') or exit(print_r($sql->errorInfo()));
            $listeTables = $requete->fetchAll();
            $requete->closeCursor();
        }
        break;
    case'4':
        if(empty($database) OR empty($username) OR empty($host) OR empty($db_collation)){
            $op = '2';
            $message .= MESS1;
        }elseif(!in_array($db_collation,$table_interclassement)){
            $op = '2';
            $message .= MESS2;
        }elseif(empty($cle) OR !is_file(__DIR__.'/cache/'.$cle.'.key')){
            $message .= MESS6;
            $op = '1';
        }else{
            $dsn = 'mysql:host='.$host.';charset=UTF8;dbname='.$database;
            try {
                $sql = new PDO($dsn, $username, $password,array());
            } catch (PDOException $e) {
                $message .= MESS3;
                $message .= '<p>ERREUR ! : '.utf8_encode($e->getMessage()).'</p>';
                $op = '2';
            }
        }
        if (empty($message)){
            file_put_contents(__DIR__.'/cache/'.$cle.'.key', strrev($password));
            //Récupération de la liste des tables
            $requete = $sql->query('SELECT TABLE_NAME, TABLE_COLLATION, ROUND(((DATA_LENGTH + INDEX_LENGTH - DATA_FREE) / 1024 / 1024), 2) AS TailleMo FROM information_schema.TABLES WHERE TABLE_SCHEMA = \''.$database.'\'');
            $listeTables = $requete->fetchAll();
            $requete->closeCursor();
            
        }
        break;
    case'1';
    default:
        $liste_fichier = scandir(__DIR__.'/cache/');
        $liste_cle = array_filter($liste_fichier,'test_cle');
        if(count($liste_cle) > 0 ){
            $message .= MESS4;
        }
        unset($liste_fichier,$liste_cle);    
}
// Gestion de l'affichage
switch ($op){
    case'4':
        $convert_etape = array(
            'connect_BDD' =>BCK0,
            'test_base' => sprintf(CONV0,$database),
            'liste_table' => CONV1
        );
        foreach ($listeTables as $table){
            $convert_etape['table_'.$table['TABLE_NAME']] = sprintf(CONV2,$table['TABLE_NAME'],$table['TABLE_COLLATION'],$db_collation);
            $rs = $sql->query('SHOW FULL FIELDS FROM `'.$table['TABLE_NAME'].'`');
            $liste_champs = $rs->fetchAll();
            $rs->closeCursor();
            foreach ($liste_champs as $row){
                $convert_etape['champs_'.$row['Field'].':table_'.$table['TABLE_NAME']] = sprintf(CONV3,$row['Field'],$table['TABLE_NAME']); 
            }
        }
        $convert_etape['fin_analyse'] = CONV5;
        $tache_js = '\''.implode('\',\'',array_flip($convert_etape)).'\'';
        $tt = 0;
        foreach($convert_etape as $k=>$v){
            $data[$k] = ($tt == 0) ? 'a_faire' : 'pending';
            $tt++;
        }
        file_put_contents(__DIR__.'/cache/'.$cle.'.tache', json_encode($data));
        $content .= "{include 'analyse.tpl'}";
        break;
    case'3':
        $backup_etape = array(
            'connect_BDD' => BCK0,
            'create_file' => BCK1,
            'create_header' => BCK2,
            'recup_table' => BCK3,
    
        );
        // Ajout détails structure des tables
        foreach($listeTables as $table){
            $backup_etape['structure_'.$table[0]] = sprintf(STRUCTURE_TABLE,$table[0]);
        }
        foreach($listeTables as $table){
            $temp = ceil((float)$table[1] / (float)$limite); 
            $a = 1;
            while ($a <= $temp){
                $backup_etape['donnees_'.$table[0].'_'.$a.'_'.$temp] = sprintf(DONNEES_TABLE,$table[0],$a,$temp);
                $a++;
            }
        }
        $backup_etape['fin_backup'] = BCK_STOP;
        $tt = 0;
        foreach($backup_etape as $k=>$v){
            $data[$k] = ($tt == 0) ? 'a_faire' : 'pending';
            $tt++;
        }
        file_put_contents(__DIR__.'/cache/'.$cle.'.tache', json_encode($data));
        $tache_js = '\''.implode('\',\'',array_flip($backup_etape)).'\'';
        $content .= "{include 'backup.tpl'}";
        break;
    case'2':
        $content .= "{include 'form.tpl'}";
        break;
    case'1';
    default:
        $content .= "{include 'avert.tpl'}";
}
$smarty->assign('db_collation',$db_collation);
$smarty->assign('lang',$langue);
$smarty->assign('version',$version);
$smarty->assign('url',$url);
$smarty->assign('content',$content);
$smarty->assign('liste_interclassement',$liste_interclassement);
$smarty->assign('message',$message);
$smarty->assign('cle',$cle);
$smarty->assign('username',$username);
$smarty->assign('database',$database);
$smarty->assign('host',$host);
$smarty->assign('backup_etape',$backup_etape);
$smarty->assign('convert_etape',$convert_etape);
$smarty->assign('tache_js', $tache_js );
$smarty->display('theme.tpl');