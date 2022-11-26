<?php
/*
	// Fichier pour la conversion de charset d'une base de donnée MySQL
	// Auteur : Cédric MONTUY
	// Date : 07 juillet 2020
	// Version : 2.00
	// Plus de détail : https://github.com/montuy337513/convert_mysql
	// Site internet : store.chg-web.com
*/
// Envoi de l'entête
header('Content-Type: application/json');

// Définition variables
$erreur = '';
$c = ''; // clé à utiliser
$a = ''; // Opération a effectuer
$h = ''; // Host mysql
$u = ''; // Utilisateur MySQL
$d = ''; // Database
$p = ''; // Collation/interclassement
$message = '';
$nb_tentative = 50;
$entree = array(
    'c' => 'string',
    'a' => 'string',
    'h' => 'string',
    'u' => 'string',
    'd' => 'string',
    'l' => 'string',
    'p' => 'string'
);
$conf_defaut = array(
    'prev' => '1',
    'day' => '',
    'lance' => '0'
);
$uri = dirname(__DIR__);
$conv_temp = array(
    'CHAR'			=>	'BINARY',
    'TEXT'			=>	'BLOB',
    'TINYTEXT'		=>	'TINYBLOB',
    'MEDIUMTEXT'            =>	'MEDIUMBLOB',
    'LONGTEXT'		=>	'LONGBLOB',
    'VARCHAR'		=>	'VARBINARY'
);
$largeur_octet = array(
    'utf8mb4' => 4,
    'utf8'  => 3,
    'utf16' => 4,
    'utf32' => 8
);
// Fonctions API
function lire_conf($cle){
    if(!is_file($GLOBALS['uri'].'/cache/'.$cle.'.conf')){
        return false;
    }
    $fp = fopen($GLOBALS['uri'].'/cache/'.$cle.'.conf','r');
    $data = '';
    if($fp){
        stream_set_read_buffer($fp,0);
        while(($buffer = fgets($fp)) !== false) {
            $data .= $buffer;
        }
        if (!feof($fp)) {
            return false;
        }
        fclose($fp);
        return json_decode($data,true);
    }
    return false;
}
function lire_tache($cle){
    if(!is_file($GLOBALS['uri'].'/cache/'.$cle.'.tache')){
        return false;
    }
    $fp = fopen($GLOBALS['uri'].'/cache/'.$cle.'.tache','r');
    $data = '';
    if($fp){
        stream_set_read_buffer($fp,0);
        while(($buffer = fgets($fp)) !== false) {
            $data .= $buffer;
        }
        if (!feof($fp)) {
            return false;
        }
        fclose($fp);
        return json_decode($data,true);
    }
    return false;
}
function sauve_conf($cle,$conf){
    $data = json_encode($conf);
    $fp = fopen($GLOBALS['uri'].'/cache/'.$cle.'.conf','w');
    if($fp){
        stream_set_write_buffer($fp,0);
        fwrite($fp,$data);
        fclose($fp);
        return true;
    }
    return false;
}
function sauve_tache($cle,$conf){
    $data = json_encode($conf);
    $fp = fopen($GLOBALS['uri'].'/cache/'.$cle.'.tache','w');
    if($fp){
        stream_set_write_buffer($fp,0);
        fwrite($fp,$data);
        fclose($fp);
        return true;
    }
    return false;
}
function sauve_backup($fichier,$data='#'){
    return file_put_contents($GLOBALS['uri'].'/sql/'.$fichier.'.sql', $data, FILE_APPEND | LOCK_EX);
}
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
// Test des variables d'entrées
if(empty($a) OR empty($c) OR empty($h) OR empty($u) OR empty($d) OR empty($l)){
    echo json_encode(array('status'=>'Erreur','message'=>'Variable(s) d\'entrée(s) inconhérente(s) a='.$a.' c='.$c.' h='.$h.' u='.$u.' d='.$d.' l='.$l));
    exit();
}
// Chargement de la langue
if(is_file($uri.'/lang/'.$l.'.php')){
    require $uri.'/lang/'.$l.'.php';
}else{
    echo json_encode(array('status'=>'Erreur','message'=>'Variable de langue inconhérente(s)'));
    exit(); 
}
// Vérification de la variable $p
if (!empty($p)){
    require $uri.'/inc/liste_interclassement.php';
    if(!in_array($p,$table_interclassement)){
        echo json_encode(array('status'=>'Erreur','message'=>'Variable de collation inconhérente(s)'));
    exit();
    }
}
// Chargement de la clé
if(is_file($uri.'/cache/'.$c.'.key')){
    $password = file_get_contents($uri.'/cache/'.$c.'.key');
}else{
    echo json_encode(array('status'=>'Erreur','message'=>MESS7));
    exit(); 
}
// Ouverture BDD
$dsn = 'mysql:host='.$h.';charset=UTF8;dbname='.$d;
try {
    $sql = new PDO($dsn, $u, strrev($password),array());
} catch (PDOException $e) {
    $erreur = MESS3.' ERREUR ! : '.utf8_encode($e->getMessage());
}
if (!empty($erreur)){
    echo json_encode(array('status'=>'Erreur','message'=>$erreur));
    exit();
}
// Lancer une sauvegarde
$zut = false;

// Gestionnaire des taches
if( !isset($tache) OR !is_array($tache) OR $tache === false){
    for($out = 0; $out < $nb_tentative; $out++){
        $tache = lire_tache($c);
        if(is_array($tache)){
            continue;
        }
        usleep(20000);
    }
    //$message .= 'Je suis passé par là';
    if(!isset($tache)){
        $fp = fopen($GLOBALS['uri'].'/cache/'.$c.'.tache','r');
        $data = stream_get_contents($fp);
        fclose($fp);
        $tache = json_decode($data,true);
        $message .= 'Je suis passé par là aussi';
    }
}
// Mise en attente des taches en cours
if(!array_key_exists($a, $tache)){
    $erreur .= "tache inconnue : ".$a;
    echo json_encode(array('status'=>'Erreur','message'=>$erreur));
    exit();
}
while ($tache[$a] != 'a_faire'){
    usleep(2000);
    $tache = lire_tache($c);
}
$conf = lire_conf($c);
if(($conf) == false){
    $conf = $conf_defaut;
}
if ($conf['prev'] == 0){
    echo json_encode(array('status'=>'Erreur','message'=>$erreur));
    exit();
}

switch($a){
    case'connect_BDD':
        $zut = true;
        break;
    case'create_file':
        $day = date('Y-m-d_H-i-s');
        $mysqlSaveDir = $uri.'/sql';
	$fileName = $d.'_'.$day.'.sql';
        if(file_put_contents($mysqlSaveDir.'/'.$fileName,'#' )){
            $conf['day'] = $d.'_'.$day;
            $zut = true;
        }else{
            $message = MESS8;
            $conf['prev'] = 0;
        }
        
        break;
    case'test_base':
        if (!empty($p)){
            $requete = $sql->query('SELECT default_character_set_name FROM information_schema.SCHEMATA WHERE schema_name = "'.$d.'";');
            $base_default_character = $requete->fetchAll();
            $requete->closeCursor();
            foreach($base_default_character as $v){
                $ancien_default_character_set_name = $v[0];
            }
            unset($requete,$base_default_character);
            $requete = $sql->query('SELECT default_collation_name FROM information_schema.SCHEMATA WHERE schema_name = "'.$d.'";');
            $base_default_collation = $requete->fetchAll();
            $requete->closeCursor();
            foreach($base_default_collation as $v){
                $ancien_default_collation_name = $v[0];
            }
            $conf['ancien_default_collation_name'] = $ancien_default_collation_name;
            $conf['ancien_default_character_set_name'] = $ancien_default_character_set_name;
            unset($requete,$base_default_character);
            $temp = explode('_',$p);
            $conf['nouveau_default_character_set_name'] = $temp[0];
            if($ancien_default_collation_name != $p){
                $conf['sql'][] = 'ALTER DATABASE `'.$d.'` DEFAULT CHARSET='.$conf['nouveau_default_character_set_name'].' COLLATE '.$p.';';
                $zut = true;
            }else{
                $zut = true;
            }
        }else{
            $conf['prev'] = 0;
            $message .= MESS11;
        }
        break;
    case'create_header':
        $entete  = "-- ----------------------\n";
        $entete .= "-- dump de la base ".$d." au ".date("d-M-Y")."\n";
	$entete .= "-- ----------------------\n\n\n";
        if(sauve_backup($conf['day'], $entete) !== false){
            $zut = true;
        }else{
            $message = MESS9;
             $conf['prev'] = 0;
        }
        break;
    case'liste_table':
        $requete = $sql->query('SELECT TABLE_NAME, TABLE_COLLATION, ENGINE, ROUND(((DATA_LENGTH + INDEX_LENGTH - DATA_FREE) / 1024 / 1024), 2) AS TailleMo FROM information_schema.TABLES WHERE TABLE_SCHEMA = \''.$d.'\'');
        $listeTables = $requete->fetchAll();
        $requete->closeCursor();
        foreach ($listeTables as $table){
            $conf['table'][$table['TABLE_NAME']] = $table['TABLE_COLLATION'];
            $conf['engine'][$table['TABLE_NAME']] = $table['ENGINE'];
        }
        $zut = true;
        break;
    case'recup_table':
        $entete = '';
        $requete = $sql->query('SELECT TABLE_NAME, ROUND(((DATA_LENGTH + INDEX_LENGTH - DATA_FREE) / 1024 / 1024), 2) AS TailleMo FROM information_schema.TABLES WHERE TABLE_SCHEMA = \''.$d.'\'') or exit(print_r($sql->errorInfo()));
        $listeTables = $requete->fetchAll();
        $requete->closeCursor();
        foreach($listeTables as $table) {
            $conf['table'][$table[0]] = $table[1];
        }
        if(sauve_backup($conf['day'], $entete) !== false){
            $zut = true;
        }else{
            $message = MESS10;
             $conf['prev'] = 0;
        }
        break;
    case'fin_analyse':
        // Ajout optimisation des tables
        // On optimise que les MyISAM
        $liste_optimise = array();
        foreach($conf['engine'] as $k=>$v){
           if( strtolower($v) == 'myisam'){
               $liste_optimise[] = $k;  
            }
        }
        if (count($liste_optimise) > 0){
            $temp = implode(',', $liste_optimise);
            $conf['sql'][] = 'OPTIMIZE TABLE '.$temp.';';
        }
     
        // Création des tâches de conversion
        unlink($uri.'/cache/'.$c.'.tache');
        unset($tache);
        $tache = array();
        if(isset($conf['sql'] ) && count($conf['sql']) > 0){
            $tt = 0;
            foreach($conf['sql'] as $v){
                $tache['conversion_'.$tt] = ($tt == 0) ? 'a_faire' : 'pending';
                $tt++;
            }
        }
    unset($conf['engine'], $conf['ancien_default_collation_name'], $conf['ancien_default_character_set_name'], $conf['nouveau_default_character_set_name'], $conf['table'],$conf['champs']);
        $zut = true;
        break;
    case'fin_conv':
        unlink($uri.'/cache/'.$c.'.key');
        unlink($uri.'/cache/'.$c.'.conf');
        unlink($uri.'/cache/'.$c.'.tache');
        $zut = true;
        break;
    case'fin_backup':
       // unlink($uri.'/cache/'.$c.'.key');
        unlink($uri.'/cache/'.$c.'.conf');
        unlink($uri.'/cache/'.$c.'.tache');
        $zut = true;
        $url = '/sql/'.$conf['day'].'.sql';
        break;
}
// Analyse table
if(substr($a,0,6) == 'table_'){
    // On récupère le nom de la table
    $nom_table = substr($a, strpos($a, '_')+1);
    // On vérifie la collation dans le tableau
    if(array_key_exists($nom_table, $conf['table']) && $conf['table'][$nom_table] != $p ){
        // Table à convertir
        $template_requete = SANS_INNO;
        if(strtolower($conf['engine'][$nom_table]) == 'innodb') {
            $template_requete = AVEC_INNO;
        }
        $requete_sql = 'ALTER TABLE `'.$nom_table.'` DEFAULT CHARSET='.$conf['nouveau_default_character_set_name'].' COLLATE '.$p;
        $conf['sql'][] = sprintf($template_requete,$requete_sql);
                /* $conf['sql'][] = 'ALTER TABLE `'.$nom_table.'` DEFAULT CHARSET='.$conf['nouveau_default_character_set_name'].' COLLATE '.$p.';';*/
    }
    // Récupération des champs de la table pour analyses ultérieures
    $requete = $sql->query('SHOW FULL FIELDS FROM `'.$nom_table.'`');
    $liste_champs = $requete->fetchAll();
    $requete->closeCursor();
    foreach($liste_champs as $champs){
        $conf['champs'][$nom_table][$champs['Field']] = $champs;
    }
    $zut = true;
}
// Analyse champs
if(substr($a,0,7) == 'champs_'){
    // On récupère le nom de la table et du champs
    $tmp = explode(':',$a);
    $nom_table = substr($tmp[1], strpos($tmp[1], '_')+1);
    $nom_champs = substr($tmp[0], strpos($tmp[0], '_')+1);
    // Vérification si on a bien les infos de la table et les champs
    if(array_key_exists($nom_table, $conf['champs']) && array_key_exists($nom_champs, $conf['champs'][$nom_table])){
        if(in_array($conf['champs'][$nom_table][$nom_champs]['Collation'],$table_interclassement) && $conf['champs'][$nom_table][$nom_champs]['Collation'] != $p){
            $template_requete = SANS_INNO;
            if(strtolower($conf['engine'][$nom_table]) == 'innodb') {
                $template_requete = AVEC_INNO;
            }
            // Récupération des clés d'indexation
            
            if ($conf['champs'][$nom_table][$nom_champs]['Key'] == 'PRI' OR $conf['champs'][$nom_table][$nom_champs]['Key'] == 'MUL' OR $conf['champs'][$nom_table][$nom_champs]['Key'] == 'UNI'){
                $longueur_cle = 0;
                // On récupère la longueur de la clé
                preg_match('|\((?<digit>\d+)\)|',$conf['champs'][$nom_table][$nom_champs]['Type'],$temp);
                if(array_key_exists('digit', $temp)){
                    $longueur_cle = $longueur_cle + (int)$temp['digit'];
                }
                // On recupère l'interclassement du champs
                $temp = explode('_',$conf['champs'][$nom_table][$nom_champs]['Collation']);
                if(array_key_exists($conf['nouveau_default_character_set_name'], $largeur_octet)){
                    $new_nb_octet = $largeur_octet[$conf['nouveau_default_character_set_name']];
                }else{
                    $new_nb_octet = 1;
                }
                if(array_key_exists($temp[0], $largeur_octet)){
                    $old_nb_octet = $largeur_octet[$temp[0]];
                }else{
                    $old_nb_octet = 1;
                }
                if($old_nb_octet < $new_nb_octet){
                    $test_cle = $longueur_cle * ceil( $new_nb_octet );
                }else{
                    $test_cle = $longueur_cle;
                }
                if ($test_cle > 1000){
                    $new_largeur = $longueur_cle / 3;
                   
                    switch($conf['champs'][$nom_table][$nom_champs]['Key']){
                        case'PRI':
                            $requete_sql = 'ALTER TABLE '.$nom_table.' DROP PRIMARY KEY, ADD PRIMARY KEY (`'.$nom_champs.'` ('.$new_largeur.')) USING BTREE';
                            break;
                        case'MUL':
                            $requete = $sql->query('SHOW INDEX FROM `'.$nom_table.'` WHERE Column_name=\''.$nom_champs.'\'');
                            $liste_index = $requete->fetchAll();
                            $requete->closeCursor();
                            foreach($liste_index as $v){
                                $nom_index = $v['Key_name'];
                                $btree = ($v['Index_type'] == 'BTREE') ? ' USING BTREE ' : '';
                            }
                            $requete_sql = 'ALTER TABLE '.$nom_table.' DROP INDEX `'.$nom_index.'` , ADD INDEX `'.$nom_index.'` (`'.$nom_champs.'` ('.$new_largeur.')) '.$btree;
                            break;
                        case'UNI':
                            $requete = $sql->query('SHOW INDEX FROM `'.$nom_table.'` WHERE Column_name=\''.$nom_champs.'\'');
                            $liste_index = $requete->fetchAll();
                            $requete->closeCursor();
                            foreach($liste_index as $v){
                                $nom_index = $v['Key_name'];
                                $btree = ($v['Index_type'] == 'BTREE') ? ' USING BTREE ' : '';
                            }
                            $requete_sql = 'ALTER TABLE '.$nom_table.' DROP INDEX `'.$nom_index.'`, ADD UNIQUE `'.$nom_index.'` (`'.$nom_champs.'` ('.$new_largeur.')) '.$btree;
                            break;
                        default:
                            $requete_sql = '';
                    }
                    $conf['sql'][] = sprintf($template_requete,$requete_sql);
                }
                
            }
            $nullable = ($conf['champs'][$nom_table][$nom_champs]['Null'] == 'YES') ? ' NULL' : ' NOT NULL';
            if($conf['champs'][$nom_table][$nom_champs]['Null'] == 'YES' && $conf['champs'][$nom_table][$nom_champs]['Default'] == NULL) {
                $default = ' DEFAULT NULL'; 
            }elseif($conf['champs'][$nom_table][$nom_champs]['Default'] != ''){
                $default = " DEFAULT '".$conf['champs'][$nom_table][$nom_champs]['Default']."'";
            }else{
                $default = '';
            }
            $mig = 0;
            $type = $conf['champs'][$nom_table][$nom_champs]['Type'];
            if(in_array($conf['champs'][$nom_table][$nom_champs]['Type'], $conv_temp)){
                $mig = 1;
                $oo = array_keys($conv_temp,$conf['champs'][$nom_table][$nom_champs]['Type']);
                $requete_sql = 'ALTER TABLE `'.$nom_table.'` CHANGE `'.$nom_champs.'` `'.$nom_champs.'` '.strtoupper($oo[0]);
                $type = strtoupper($oo[0]);
                $conf['sql'][] = sprintf($template_requete,$requete_sql);
            }
            $requete_sql = 'ALTER TABLE `'.$nom_table.'` CHANGE `'.$nom_champs.'` `'.$nom_champs.'` '.$type.' CHARACTER SET '.$conf['nouveau_default_character_set_name'].' COLLATE '.$p.' '.$nullable.' '.$default;
            $conf['sql'][] = sprintf($template_requete,$requete_sql);
            if ($mig == 1){
                $requete_sql = 'ALTER TABLE `'.$nom_table.'` CHANGE `'.$nom_champs.'` `'.$nom_champs.'` '.strtoupper($conf['champs'][$nom_table]['Type']);
                $conf['sql'][] = sprintf($template_requete,$requete_sql);
            }
            $zut = true;
        }else{
            // Le champs n'a pas besoin de conversion
            $zut = true;
        }
    }else{
        $message .= MESS12.' table : '.$nom_table.' champs : '.$nom_champs;
    }
}
// Backup structure table
if(substr($a,0,10) == 'structure_' ){
    
    $temp = substr($a, strpos($a, '_')+1);
    $entete = '';
    //foreach ($conf['table'] as $k => $v){
        $entete .= "-- -----------------------------\n";
        $entete .= "-- Structure de la table ".$temp."\n";
        $entete .= "-- -----------------------------\n";
        $requete = $sql->query('SHOW CREATE TABLE '.$temp);
	$listeCreationsTables = $requete->fetchAll();
	$requete->closeCursor();
        foreach ($listeCreationsTables as $creationTable) {
            $entete .= $creationTable[1].";\n\n";
        }
        if(sauve_backup($conf['day'], $entete) !== false){
            $zut = true;
        }else{
            $message = MESS10;
             $conf['prev'] = 0;
        }
    //}
}
// Backup des données
if(substr($a,0,8) == 'donnees_' ){
    $temp = substr($a, strpos($a, '_')+1);
    $entete = '';
    $tableau = explode('_', $temp);
    $tot = count($tableau);
    $table = implode('_',array_slice($tableau,0,$tot - 2));
    $page = $tableau[$tot - 2];
    $fin = $tableau[$tot - 1];
    if ($page == 1){
        $entete .= "-- -----------------------------\n";
        $entete .= "-- Contenu de la table ".$table."\n";
        $entete .= "-- -----------------------------\n";
    }
    if($fin == 1){

        $requete = $sql->query('SELECT  * FROM '.$table);
	$donnees = $requete->fetchAll();
        foreach($donnees as $nuplet) {
            $entete .= "INSERT INTO `".$table."` VALUES(";
            for($i=0; $i < $requete->columnCount(); $i++) {
                if($i != 0){
                    $entete .=  ", ";
                }
                if($requete->getColumnMeta($i) == "string" || $requete->getColumnMeta($i) == "blob") {
                    $entete .=  "'";
		}
                $entete .= addslashes($nuplet[$i]);
                if($requete->getColumnMeta($i) == "string" || $requete->getColumnMeta($i) == "blob") {
                    $entete .=  "'";
		}
            }
            $entete .=  ");\n";
        }
        $requete->closeCursor();
    }else{
        $requete = $sql->query('SELECT COUNT(*) FROM '.$table);
        $donnees = $requete->fetchAll();
        $requete->closeCursor();
        foreach($donnees as $ligne) {
            $nb_ligne = $ligne[0];
        }
        $offset = ceil($nb_ligne / $fin);
        $limit = ($page - 1) * $offset;
        $requete = $sql->query('SELECT  * FROM '.$table.' LIMIT '.$limit.', '.$offset);
	$donnees = $requete->fetchAll();
        foreach($donnees as $nuplet) {
            $entete .= "INSERT INTO `".$table."` VALUES(";
            for($i=0; $i < $requete->columnCount(); $i++) {
                if($i != 0){
                    $entete .=  ", ";
                }
                if($requete->getColumnMeta($i) == "string" || $requete->getColumnMeta($i) == "blob") {
                    $entete .=  "'";
		}
                $entete .= addslashes($nuplet[$i]);
                if($requete->getColumnMeta($i) == "string" || $requete->getColumnMeta($i) == "blob") {
                    $entete .=  "'";
		}
            }
            $entete .=  ");\n";
        }
        $requete->closeCursor();
        
    }
    if(sauve_backup($conf['day'], $entete) !== false){
            $zut = true;
        }else{
            $message = MESS10;
             $conf['prev'] = 0;
        }
    
}
// Exécution requetes de conversions
if(substr($a,0,11) == 'conversion_' ){
    $temp = explode('_',$a);
    $nb_requete = $temp[1];
    $sql->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    if(count($conf['sql']) > 0 && isset($conf['sql'][$nb_requete])){
        /*reset($conf['sql']);*/
        /*$n = array_key_first($conf['sql']);*/
        $sql->beginTransaction();
        try {
        // $sql->exec($conf['sql'][$n]);
        //$nb = current($conf['sql']);
            $sql->exec($conf['sql'][$nb_requete]);
            if($sql->commit() === false){
                $conf['prev'] = 0;
                $message .= 'Erreur requete :'.$conf['sql'][$nb_requete];
            }else{
                $zut = true;
            }
            // Supprime la requet sql du tableau
            unset($conf['sql'][$nb_requete]);
        } catch (Exception $e) {
            $sql->rollBack();
            $message .= 'Erreur requete :'.$conf['sql'][$nb_requete].' | '.$e->getMessage();
            $conf['prev'] = 0;
        }
    }else{
        $conf['prev'] = 0;
        $message = MESS13;
    }
}


// Gestion des messages retour
if ($zut == true){
    $suite='undefine';
    $hh = 0;
    foreach($tache as $k=>$v){
        if($v == 'pending' && $hh == 0){
            $suite = $k;
            $hh = 1;
        }
    }
    if ($a != 'fin_analyse'){
        if(substr($a,0,11) == 'conversion_' ){
            $nb_tache = count($tache);
            $n_conv = $nb_requete + 1;
            if($nb_tache == $n_conv){
                if(count($conf['sql']) > 0){
                    unset($conf['sql']);
                }
                $tache[$a] = 'ok';
            }else{
                $tache[$a] = 'ok';
                if(array_key_exists($suite,$tache)){
                    $tache[$suite] = 'a_faire';
                }
            }
        
        }else{
            $tache[$a] = 'ok';
            if(array_key_exists($suite,$tache)){
                $tache[$suite] = 'a_faire';
            }
        }
    }
    
    
    if($a != 'fin_backup'){
        $message .= 'ok';
        if (!empty($p) && array_key_exists('sql', $conf)){
            $message = 'ok '.count($conf['sql']);
        }elseif(!empty($p)){
            $message = 'ok 0';
        }
        echo json_encode(array('status'=>str_replace(':','_',$a),'message'=>$message));
    }else{
        echo json_encode(array('status'=>$a,'message'=>$GLOBALS['uri'].'/sql/'.$conf['day'].'.sql'));
    }
}else{
   $conf['prev'] = 0; 
   $message = $erreur.' '.$message;
   echo json_encode(array('status'=>'Erreur','message'=>$message)); 
}
// Sauvegarde des tableaux
if($a != 'fin_backup'){
    sauve_conf($c, $conf);
    sauve_tache($c, $tache);
}