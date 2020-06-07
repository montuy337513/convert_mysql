<?php
/*
	// Fichier pour la conversion d'une base de donnée MySQL latin vers UTF-8
	// Auteur : Cédric MONTUY
	// Date : 07 juillet 2020
	// Version : 2.00
	// Plus de détail : https://github.com/montuy337513/convert_mysql
	// Site internet : www.chg-web.com
*/
if (!ini_get('safe_mode')) {
	set_time_limit(0);
}
if (version_compare(PHP_VERSION,'7.0.0', '<')) {
	die ('Version 7.0.0 de PHP requis');
}
session_start();
$content = '';
$op = 1;
$sauvegarde = '';
$username = '';
$password = '';
$database = '';
$host = 'localhost';
$de = 'latin1_swedish_ci';
$vers = 'utf8_general_ci';
$character_set= 'utf8';
$version = '1.01';
$conv_temp = array(
	'CHAR'			=>	'BINARY',
	'TEXT'			=>	'BLOB',
	'TINYTEXT'		=>	'TINYBLOB',
	'MEDIUMTEXT'	=>	'MEDIUMBLOB',
	'LONGTEXT'		=>	'LONGBLOB',
	'VARCHAR'		=>	'VARBINARY'
	);
$liste_interclassement = '<select name="db_collation"><option value="">Interclassement</option><option value=""></option><optgroup label="armscii8" title="ARMSCII-8 Armenian"><option value="armscii8_bin" title="arménien, Binaire">armscii8_bin</option><option value="armscii8_general_ci" title="arménien, insensible à la casse">armscii8_general_ci</option></optgroup><optgroup label="ascii" title="US ASCII"><option value="ascii_bin" title="Europe de l\'ouest (multilingue), Binaire">ascii_bin</option><option value="ascii_general_ci" title="Europe de l\'ouest (multilingue), insensible à la casse">ascii_general_ci</option></optgroup><optgroup label="big5" title="Big5 Traditional Chinese"><option value="big5_bin" title="chinois traditionnel, Binaire">big5_bin</option><option value="big5_chinese_ci" title="chinois traditionnel, insensible à la casse">big5_chinese_ci</option>
</optgroup>
<optgroup label="binary" title="Binary pseudo charset">
<option value="binary" title="Binaire">binary</option>
</optgroup>
<optgroup label="cp1250" title="Windows Central European">
<option value="cp1250_bin" title="Europe centrale (multilingue), Binaire">cp1250_bin</option>
<option value="cp1250_croatian_ci" title="croate, insensible à la casse">cp1250_croatian_ci</option>
<option value="cp1250_czech_cs" title="tchèque, sensible à la casse">cp1250_czech_cs</option>
<option value="cp1250_general_ci" title="Europe centrale (multilingue), insensible à la casse">cp1250_general_ci</option>
<option value="cp1250_polish_ci" title="polonais, insensible à la casse">cp1250_polish_ci</option>
</optgroup>
<optgroup label="cp1251" title="Windows Cyrillic">
<option value="cp1251_bin" title="cyrillique (multilingue), Binaire">cp1251_bin</option>
<option value="cp1251_bulgarian_ci" title="bulgare, insensible à la casse">cp1251_bulgarian_ci</option>
<option value="cp1251_general_ci" title="cyrillique (multilingue), insensible à la casse">cp1251_general_ci</option>
<option value="cp1251_general_cs" title="cyrillique (multilingue), sensible à la casse">cp1251_general_cs</option>
<option value="cp1251_ukrainian_ci" title="ukrainien, insensible à la casse">cp1251_ukrainian_ci</option>
</optgroup>
<optgroup label="cp1256" title="Windows Arabic">
<option value="cp1256_bin" title="arabe, Binaire">cp1256_bin</option>
<option value="cp1256_general_ci" title="arabe, insensible à la casse">cp1256_general_ci</option>
</optgroup>
<optgroup label="cp1257" title="Windows Baltic">
<option value="cp1257_bin" title="baltique (multilingue), Binaire">cp1257_bin</option>
<option value="cp1257_general_ci" title="baltique (multilingue), insensible à la casse">cp1257_general_ci</option>
<option value="cp1257_lithuanian_ci" title="lituanien, insensible à la casse">cp1257_lithuanian_ci</option>
</optgroup>
<optgroup label="cp850" title="DOS West European">
<option value="cp850_bin" title="Europe de l\'ouest (multilingue), Binaire">cp850_bin</option>
<option value="cp850_general_ci" title="Europe de l\'ouest (multilingue), insensible à la casse">cp850_general_ci</option>
</optgroup>
<optgroup label="cp852" title="DOS Central European">
<option value="cp852_bin" title="Europe centrale (multilingue), Binaire">cp852_bin</option>
<option value="cp852_general_ci" title="Europe centrale (multilingue), insensible à la casse">cp852_general_ci</option>
</optgroup>
<optgroup label="cp866" title="DOS Russian">
<option value="cp866_bin" title="russe, Binaire">cp866_bin</option>
<option value="cp866_general_ci" title="russe, insensible à la casse">cp866_general_ci</option>
</optgroup>
<optgroup label="cp932" title="SJIS for Windows Japanese">
<option value="cp932_bin" title="japonais, Binaire">cp932_bin</option>
<option value="cp932_japanese_ci" title="japonais, insensible à la casse">cp932_japanese_ci</option>
</optgroup>
<optgroup label="dec8" title="DEC West European">
<option value="dec8_bin" title="Europe de l\'ouest (multilingue), Binaire">dec8_bin</option>
<option value="dec8_swedish_ci" title="suédois, insensible à la casse">dec8_swedish_ci</option>
</optgroup>
<optgroup label="eucjpms" title="UJIS for Windows Japanese">
<option value="eucjpms_bin" title="japonais, Binaire">eucjpms_bin</option>
<option value="eucjpms_japanese_ci" title="japonais, insensible à la casse">eucjpms_japanese_ci</option>
</optgroup>
<optgroup label="euckr" title="EUC-KR Korean">
<option value="euckr_bin" title="coréen, Binaire">euckr_bin</option>
<option value="euckr_korean_ci" title="coréen, insensible à la casse">euckr_korean_ci</option>
</optgroup>
<optgroup label="gb2312" title="GB2312 Simplified Chinese">
<option value="gb2312_bin" title="chinois simplifié, Binaire">gb2312_bin</option>
<option value="gb2312_chinese_ci" title="chinois simplifié, insensible à la casse">gb2312_chinese_ci</option>
</optgroup>
<optgroup label="gbk" title="GBK Simplified Chinese">
<option value="gbk_bin" title="chinois simplifié, Binaire">gbk_bin</option>
<option value="gbk_chinese_ci" title="chinois simplifié, insensible à la casse">gbk_chinese_ci</option>
</optgroup>
<optgroup label="geostd8" title="GEOSTD8 Georgian">
<option value="geostd8_bin" title="géorgien, Binaire">geostd8_bin</option>
<option value="geostd8_general_ci" title="géorgien, insensible à la casse">geostd8_general_ci</option>
</optgroup>
<optgroup label="greek" title="ISO 8859-7 Greek">
<option value="greek_bin" title="grec, Binaire">greek_bin</option>
<option value="greek_general_ci" title="grec, insensible à la casse">greek_general_ci</option>
</optgroup>
<optgroup label="hebrew" title="ISO 8859-8 Hebrew">
<option value="hebrew_bin" title="hébreu, Binaire">hebrew_bin</option>
<option value="hebrew_general_ci" title="hébreu, insensible à la casse">hebrew_general_ci</option>
</optgroup>
<optgroup label="hp8" title="HP West European">
<option value="hp8_bin" title="Europe de l\'ouest (multilingue), Binaire">hp8_bin</option>
<option value="hp8_english_ci" title="anglais, insensible à la casse">hp8_english_ci</option>
</optgroup>
<optgroup label="keybcs2" title="DOS Kamenicky Czech-Slovak">
<option value="keybcs2_bin" title="tchèque-slovaque, Binaire">keybcs2_bin</option>
<option value="keybcs2_general_ci" title="tchèque-slovaque, insensible à la casse">keybcs2_general_ci</option>
</optgroup>
<optgroup label="koi8r" title="KOI8-R Relcom Russian">
<option value="koi8r_bin" title="russe, Binaire">koi8r_bin</option>
<option value="koi8r_general_ci" title="russe, insensible à la casse">koi8r_general_ci</option>
</optgroup>
<optgroup label="koi8u" title="KOI8-U Ukrainian">
<option value="koi8u_bin" title="ukrainien, Binaire">koi8u_bin</option>
<option value="koi8u_general_ci" title="ukrainien, insensible à la casse">koi8u_general_ci</option>
</optgroup>
<optgroup label="latin1" title="cp1252 West European">
<option value="latin1_bin" title="Europe de l\'ouest (multilingue), Binaire">latin1_bin</option>
<option value="latin1_danish_ci" title="danois, insensible à la casse">latin1_danish_ci</option>
<option value="latin1_general_ci" title="Europe de l\'ouest (multilingue), insensible à la casse">latin1_general_ci</option>
<option value="latin1_general_cs" title="Europe de l\'ouest (multilingue), sensible à la casse">latin1_general_cs</option>
<option value="latin1_german1_ci" title="allemand (dictionnaire), insensible à la casse">latin1_german1_ci</option>
<option value="latin1_german2_ci" title="allemand (annuaire téléphonique), insensible à la casse">latin1_german2_ci</option>
<option value="latin1_spanish_ci" title="espagnol, insensible à la casse">latin1_spanish_ci</option>
<option value="latin1_swedish_ci" title="suédois, insensible à la casse" selected="selected">latin1_swedish_ci</option>
</optgroup>
<optgroup label="latin2" title="ISO 8859-2 Central European">
<option value="latin2_bin" title="Europe centrale (multilingue), Binaire">latin2_bin</option>
<option value="latin2_croatian_ci" title="croate, insensible à la casse">latin2_croatian_ci</option>
<option value="latin2_czech_cs" title="tchèque, sensible à la casse">latin2_czech_cs</option>
<option value="latin2_general_ci" title="Europe centrale (multilingue), insensible à la casse">latin2_general_ci</option>
<option value="latin2_hungarian_ci" title="hongrois, insensible à la casse">latin2_hungarian_ci</option>
</optgroup>
<optgroup label="latin5" title="ISO 8859-9 Turkish">
<option value="latin5_bin" title="turc, Binaire">latin5_bin</option>
<option value="latin5_turkish_ci" title="turc, insensible à la casse">latin5_turkish_ci</option>
</optgroup>
<optgroup label="latin7" title="ISO 8859-13 Baltic">
<option value="latin7_bin" title="baltique (multilingue), Binaire">latin7_bin</option>
<option value="latin7_estonian_cs" title="estonien, sensible à la casse">latin7_estonian_cs</option>
<option value="latin7_general_ci" title="baltique (multilingue), insensible à la casse">latin7_general_ci</option>
<option value="latin7_general_cs" title="baltique (multilingue), sensible à la casse">latin7_general_cs</option>
</optgroup>
<optgroup label="macce" title="Mac Central European">
<option value="macce_bin" title="Europe centrale (multilingue), Binaire">macce_bin</option>
<option value="macce_general_ci" title="Europe centrale (multilingue), insensible à la casse">macce_general_ci</option>
</optgroup>
<optgroup label="macroman" title="Mac West European">
<option value="macroman_bin" title="Europe de l\'ouest (multilingue), Binaire">macroman_bin</option>
<option value="macroman_general_ci" title="Europe de l\'ouest (multilingue), insensible à la casse">macroman_general_ci</option>
</optgroup>
<optgroup label="sjis" title="Shift-JIS Japanese">
<option value="sjis_bin" title="japonais, Binaire">sjis_bin</option>
<option value="sjis_japanese_ci" title="japonais, insensible à la casse">sjis_japanese_ci</option>
</optgroup>
<optgroup label="swe7" title="7bit Swedish">
<option value="swe7_bin" title="suédois, Binaire">swe7_bin</option>
<option value="swe7_swedish_ci" title="suédois, insensible à la casse">swe7_swedish_ci</option>
</optgroup>
<optgroup label="tis620" title="TIS620 Thai">
<option value="tis620_bin" title="thaï, Binaire">tis620_bin</option>
<option value="tis620_thai_ci" title="thaï, insensible à la casse">tis620_thai_ci</option>
</optgroup>
<optgroup label="ucs2" title="UCS-2 Unicode">
<option value="ucs2_bin" title="Unicode (multilingue), Binaire">ucs2_bin</option>
<option value="ucs2_czech_ci" title="tchèque, insensible à la casse">ucs2_czech_ci</option>
<option value="ucs2_danish_ci" title="danois, insensible à la casse">ucs2_danish_ci</option>
<option value="ucs2_esperanto_ci" title="Espéranto, insensible à la casse">ucs2_esperanto_ci</option>
<option value="ucs2_estonian_ci" title="estonien, insensible à la casse">ucs2_estonian_ci</option>
<option value="ucs2_general_ci" title="Unicode (multilingue), insensible à la casse">ucs2_general_ci</option>
<option value="ucs2_general_mysql500_ci" title="Unicode (multilingue)">ucs2_general_mysql500_ci</option>
<option value="ucs2_hungarian_ci" title="hongrois, insensible à la casse">ucs2_hungarian_ci</option>
<option value="ucs2_icelandic_ci" title="islandais, insensible à la casse">ucs2_icelandic_ci</option>
<option value="ucs2_latvian_ci" title="letton, insensible à la casse">ucs2_latvian_ci</option>
<option value="ucs2_lithuanian_ci" title="lituanien, insensible à la casse">ucs2_lithuanian_ci</option>
<option value="ucs2_persian_ci" title="perse, insensible à la casse">ucs2_persian_ci</option>
<option value="ucs2_polish_ci" title="polonais, insensible à la casse">ucs2_polish_ci</option>
<option value="ucs2_roman_ci" title="Europe de l\'ouest, insensible à la casse">ucs2_roman_ci</option>
<option value="ucs2_romanian_ci" title="roumain, insensible à la casse">ucs2_romanian_ci</option>
<option value="ucs2_slovak_ci" title="slovaque, insensible à la casse">ucs2_slovak_ci</option>
<option value="ucs2_slovenian_ci" title="slovène, insensible à la casse">ucs2_slovenian_ci</option>
<option value="ucs2_spanish2_ci" title="espagnol traditionnel, insensible à la casse">ucs2_spanish2_ci</option>
<option value="ucs2_spanish_ci" title="espagnol, insensible à la casse">ucs2_spanish_ci</option>
<option value="ucs2_swedish_ci" title="suédois, insensible à la casse">ucs2_swedish_ci</option>
<option value="ucs2_turkish_ci" title="turc, insensible à la casse">ucs2_turkish_ci</option>
<option value="ucs2_unicode_ci" title="Unicode (multilingue), insensible à la casse">ucs2_unicode_ci</option>
</optgroup>
<optgroup label="ujis" title="EUC-JP Japanese">
<option value="ujis_bin" title="japonais, Binaire">ujis_bin</option>
<option value="ujis_japanese_ci" title="japonais, insensible à la casse">ujis_japanese_ci</option>
</optgroup>
<optgroup label="utf8" title="UTF-8 Unicode">
<option value="utf8_bin" title="Unicode (multilingue), Binaire">utf8_bin</option>
<option value="utf8_czech_ci" title="tchèque, insensible à la casse">utf8_czech_ci</option>
<option value="utf8_danish_ci" title="danois, insensible à la casse">utf8_danish_ci</option>
<option value="utf8_esperanto_ci" title="Espéranto, insensible à la casse">utf8_esperanto_ci</option>
<option value="utf8_estonian_ci" title="estonien, insensible à la casse">utf8_estonian_ci</option>
<option value="utf8_general_ci" title="Unicode (multilingue), insensible à la casse">utf8_general_ci</option>
<option value="utf8_general_mysql500_ci" title="Unicode (multilingue)">utf8_general_mysql500_ci</option>
<option value="utf8_hungarian_ci" title="hongrois, insensible à la casse">utf8_hungarian_ci</option>
<option value="utf8_icelandic_ci" title="islandais, insensible à la casse">utf8_icelandic_ci</option>
<option value="utf8_latvian_ci" title="letton, insensible à la casse">utf8_latvian_ci</option>
<option value="utf8_lithuanian_ci" title="lituanien, insensible à la casse">utf8_lithuanian_ci</option>
<option value="utf8_persian_ci" title="perse, insensible à la casse">utf8_persian_ci</option>
<option value="utf8_polish_ci" title="polonais, insensible à la casse">utf8_polish_ci</option>
<option value="utf8_roman_ci" title="Europe de l\'ouest, insensible à la casse">utf8_roman_ci</option>
<option value="utf8_romanian_ci" title="roumain, insensible à la casse">utf8_romanian_ci</option>
<option value="utf8_slovak_ci" title="slovaque, insensible à la casse">utf8_slovak_ci</option>
<option value="utf8_slovenian_ci" title="slovène, insensible à la casse">utf8_slovenian_ci</option>
<option value="utf8_spanish2_ci" title="espagnol traditionnel, insensible à la casse">utf8_spanish2_ci</option>
<option value="utf8_spanish_ci" title="espagnol, insensible à la casse">utf8_spanish_ci</option>
<option value="utf8_swedish_ci" title="suédois, insensible à la casse">utf8_swedish_ci</option>
<option value="utf8_turkish_ci" title="turc, insensible à la casse">utf8_turkish_ci</option>
<option value="utf8_unicode_ci" title="Unicode (multilingue), insensible à la casse">utf8_unicode_ci</option>
</optgroup>
</select>';
$etape = 'Etape 1 : Avertissement';
if (isset($_POST['op'])) {
	$op = intval($_POST['op']);
}
if (isset($_POST['sauvegarde'])) {
	$sauvegarde = filter_var($_POST['sauvegarde'], FILTER_SANITIZE_STRING );
	switch (strtolower($sauvegarde)) {
		case'oui':
			$_SESSION['sauvegarde'] = 1;
			break;
		case'non':
			$_SESSION['sauvegarde'] = 2;
			break;
		default:
			$op = 1;
	}
}
if (isset($_POST['db_collation'])) {
	$_SESSION['de'] = filter_var($_POST['db_collation'], FILTER_SANITIZE_STRING );
}
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['database']) && isset($_POST['host'])) {
	$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING );
	$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING );
	$database = filter_var($_POST['database'], FILTER_SANITIZE_STRING );
	$host = filter_var($_POST['host'], FILTER_SANITIZE_STRING );
	$_SESSION['username'] = $username;
	$_SESSION['password'] = $password;
	$_SESSION['database'] = $database;
	$_SESSION['host'] = $host;
	$dsn = 'mysql:host='.$_SESSION['host'].';dbname='.$_SESSION['database'];
	try {
		$sql = new PDO($dsn, $_SESSION['username'], $_SESSION['password'],array(
																//PDO::ATTR_PERSISTENT => true
															));
	} catch (PDOException $e) {
		$content .= '<p>ERREUR ! : '.$e->getMessage().'</p>';
		$content .= '<p>Impossible de se connecter au serveur SQL. Merci de v&eacute;rifier les valeurs de connexions</p>';
		$op = 3;
	}
	if (isset($_SESSION['sauvegarde']) && $_SESSION['sauvegarde'] == 1) {
		$op = 5;
	}
}
switch($op) {
	case'5':
		$fait = false;
		$table = '';
		$queries = array();
		$u = 0;
		$in = false;
		$etape = 'Etape 5 : Conversion de la base de donn&eacute;es';
		$dsn = 'mysql:host='.$_SESSION['host'].';dbname='.$_SESSION['database'];
		try {
			$sql = new PDO($dsn, $_SESSION['username'], $_SESSION['password'],array(
																					//PDO::ATTR_PERSISTENT => true																
																					));
		} catch (PDOException $e) {
			$content .= '<p>ERREUR ! : '.$e->getMessage().'</p>';
			$content .= '<p>Impossible de se connecter au serveur SQL. Merci de recommencer</p>';
			break;
		}
		$ordre = array();
		$content .= '<pre>';
		try {
			$sql->exec('ALTER DATABASE `'.$_SESSION['database'].'` DEFAULT CHARACTER SET '.$character_set.' COLLATE '.$vers); 
		}  catch (PDOException $e) {
			$content .= 'Erreur de conversion de la base de donn&eacute;s : '.$_SESSION['database'].'<br />';
			break;
		}
		$rs_tables = $sql->query('SHOW TABLE STATUS') or exit(print_r($sql->errorInfo()));
		$listing_table = $rs_tables->fetchAll();
		$rs_tables->closeCursor();
		unset($rs_tables);
		$liste_optimise = '';
		foreach($listing_table as $row_table) {
			$table = $row_table['Name'];
			$liste_optimise .= '`'.$table.'`,';
			$tableau = array();
			$liste_champs = '';
			if(strtolower($row_table['Engine']) == 'innodb') {
				$in = true;
			} else {
				$in = false;
			}
			if ($row_table['Collation'] != $vers) {
				$queries[$u]['content'] = 'Conversion de la table '.$table.' en '.$character_set.'<br />';
				$queries[$u]['requete'] = 'ALTER TABLE `'.$table.'` DEFAULT CHARACTER SET '.$character_set;
				$u++;
			} else {
				$content .= 'Lecture des champs de la table '.$table.'<br />';
			}
			$key = 0;
			$n = 0;
			$rs = $sql->query('SHOW FULL FIELDS FROM `'.$table.'`')or exit(print_r($sql->errorInfo()));
			$liste_champs = $rs->fetchAll();
			$rs->closeCursor();
			unset($rs);
			$listing_key = array();
			foreach ($liste_champs as $row){
				$temp = 0;
				if ($row['Key'] == 'PRI') {
					$temp = substr( $row['Type'], strpos($row['Type'], '(')+1,strlen($row['Type']) );
					$temp = substr($temp, 0,strpos($temp, ')'));
					$key = $key + $temp;
				}
				$tableau[$n] = $row;
				$tableau[$n]['temp'] = $temp;
				$n ++;
			}
			unset ($n);
			$key = $key * 3;
			if ($key > 1000) {
				$modif_key2 = array();
				$n = 0;
				foreach ($tableau as $v) {
					if ($v['Key'] == 'PRI') {
						$modif_key2[$n] = '`'.$v['Field'].'` ('.intval($v['temp'] / 2).') ';
						$n++;
					}
				}
				if (count($modif_key2) > 0) {
					$num2 = implode(' , ',$modif_key2);
					if ($in) {
						$queries[$u]['content'] = 'Cl&eacute; InnoDB';
						$queries[$u]['requete'] =  'SET foreign_key_checks = 0';
						$u++;
					} else {
						$queries[$u]['content'] = 'Conversion des cl&eacute;s d\'indexation';
						$queries[$u]['requete'] = 'ALTER TABLE '.$table.' DROP PRIMARY KEY, ADD PRIMARY KEY ('.$num2.')';
						$u++;
					}
				}
				unset ($v, $num2, $modif_key, $modif_key2,$liste_champs);
			}
			foreach ($tableau as $k=>$v) {
				if ($v['Collation'] != $de)
            		continue;
				if ($v['Null'] == 'YES') {
  			    	$nullable = ' NULL ';
			    } else {
          			$nullable = ' NOT NULL';
				}
				if ($v['Default'] == NULL && $v['Null'] == 'YES') {
            		$default = ' DEFAULT NULL';
        		} else if ($v['Default'] != '') {
            		$default = " DEFAULT '".$v['Default']."'";
        		} else {
            		$default = '';
        		}
				$field = $v['Field'];
				if ($in) {
					$queries[$u]['content'] = 'Cl&eacute; InnoDB';
					$queries[$u]['requete'] =  'SET foreign_key_checks = 0';
					$u++;
				}
				if (array_key_exists(strtoupper($v['Type']), $conv_temp)) {
					$queries[$u]['content'] = 'Pr&eacute;paration &agrave; la conversion du champs '.$field;
					$queries[$u]['requete'] = 'ALTER TABLE `'.$table.'` CHANGE `'.$field.'` `'.$field.'` '.$conv_temp[strtoupper($v['Type'])];
					$u++;
				}
				$queries[$u]['content'] = 'Conversion du champs '.$field;
				$queries[$u]['requete'] = 'ALTER TABLE `'.$table.'` CHANGE `'.$field.'` `'.$field.'` '.$v['Type'].' CHARACTER SET '.$character_set.' COLLATE '.$vers.' '.$nullable.' '.$default;
				$u++;
			}
			
		}
		$liste_optimise = substr($liste_optimise, 0,strpos($liste_optimise, ','));
		$queries[$u]['content'] = 'Optimisation de la base de donn&eacute;es';
		$queries[$u]['requete'] = 'OPTIMIZE TABLE '.$liste_optimise;
			
		if (count($queries) > 0) {
			$sql->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			foreach ($queries as $j) {
				$sql->beginTransaction();
				try {
					$sql->exec($j['requete']) ;
					$content .= $j['content'].' : OK<br />';
					$sql->commit();
					
				} catch (PDOException $e){
					print "Requete : ".$j['requete'].'<br />';					
					print "Erreur ! : " . $e->getMessage() . "<br/>";
					$sql->rollBack();
				}
			}
		}
		$content .= '</pre>';
		$content .= 'Processus termin&eacute;';
		break;
	case'4':
		$entete = '';
		$creation = '';
		$insertions = '';
		$day = date('Y-m-d_H-i-s');
		$mysqlSaveDir = './sql';
		$fileName = 'mon-site_'.$day.'.sql';
		$etape = 'Etape 4 : Sauvegarde de la base de donn&eacute;es';
		$content .= '<p>Sauvegarde de la base de donn&eacute;es en cours...</p>';
		$content .= '<p>Merci de patienter...</p>';
		$entete  = "-- ----------------------\n";
   		$entete .= "-- dump de la base ".$_SESSION['database']." au ".date("d-M-Y")."\n";
		$entete .= "-- ----------------------\n\n\n";
		$creations = "";
		$insertions = "\n\n";
		$requete = $sql->query('SHOW TABLES') or exit(print_r($sql->errorInfo()));
		$listeTables = $requete->fetchAll();
		$requete->closeCursor();
		unset($requete);
		foreach($listeTables as $table) {
			$creations .= "-- -----------------------------\n";
            $creations .= "-- Structure de la table ".$table[0]."\n";
            $creations .= "-- -----------------------------\n";
			$requete = $sql->query('SHOW CREATE TABLE '.$table[0]);
			$listeCreationsTables = $requete->fetchAll();
			$requete->closeCursor();
			unset($requete);
            foreach ($listeCreationsTables as $creationTable) {
              $creations .= $creationTable[1].";\n\n";
            }
            $insertions .= "-- -----------------------------\n";
            $insertions .= "-- Contenu de la table ".$table[0]."\n";
            $insertions .= "-- -----------------------------\n";
			$requete = $sql->query('SELECT  * FROM '.$table[0]);
			$donnees = $requete->fetchAll();
            foreach($donnees as $nuplet) {
                $insertions .= "INSERT INTO ".$table[0]." VALUES(";
                for($i=0; $i < $requete->columnCount(); $i++) {
                  if($i != 0)
                     $insertions .=  ", ";
                  if($requete->getColumnMeta($i) == "string" || $requete->getColumnMeta($i) == "blob") {
                  	$insertions .=  "'";
				  }
                  $insertions .= addslashes($nuplet[$i]);
                  if($requete->getColumnMeta($i) == "string" || $requete->getColumnMeta($i) == "blob") {
                    $insertions .=  "'";
				  }
                }
                $insertions .=  ");\n";
            }
            $insertions .= "\n";
		}
		if (ini_get('zlib.output_compression') === false) {
			$dump = fopen($mysqlSaveDir.'/'.$fileName, 'wb');
			fwrite($dump, $entete);
			fwrite($dump, $creations);
			fwrite($dump, $insertions);
			fclose($dump);
		} else {
			$fileName = $fileName.'.gz';
			$dump = gzopen($mysqlSaveDir.'/'.$fileName, 'wb');
			gzwrite($dump, $entete);
			gzwrite($dump, $creations);
			gzwrite($dump, $insertions);
			gzclose($dump);
		}
		$content .= '<p>Sauvegarde de la base de donn&eacute;es du site termin&eacute;e...</p>';
		$content .= '<p><a href="'.$mysqlSaveDir.'/'.$fileName.'">T&eacute;l&eacute;chargez la sauvegarde</a></p>';
		$content .= '<input type="hidden" name="op" value="5" />';
		$content .= '<input type="submit" value="Suivant" class="bouton"/>';
		break;
	case'2': 
		$etape = 'Etape 2 : S&eacute;lection de l\'interclassement d\'origine';
		$content .= '<p>Veuillez choisir l\'interclassement d\'origine de vos tables</p>';
		$content .= '<br />';
		$content .= $liste_interclassement;
		$content .= '<input type="hidden" name="op" value="3" />';
		$content .= '<input type="submit" value="Suivant" class="bouton"/>';
		break;
	case'3':
		$etape = 'Etape 3 : Param&egrave;tres de connexion a MySQL';
		$content .= '<p>Merci d\'indiquer les param&egrave;tres de connexion a votre base de données MySQL</p>';
		$content .= '<br />';
		$content .= '<div class="ligne"><div class="texte">Nom utilisateur</div><div class="nom"><input type="text" name="username" value="'.$username.'" /></div></div>';
		$content .= '<div class="ligne"><div class="texte">Mot de passe connexion</div><div class="nom"><input type="password" name="password" value="'.$password.'" /></div></div>';
		$content .= '<div class="ligne"><div class="texte">Nom de la base de données a convertir</div><div class="nom"><input type="text" name="database" value="'.$database.'" /></div></div>';
		$content .= '<div class="ligne"><div class="texte">Hostname (par défaut : localhost)</div><div class="nom"><input type="text" name="host" value="'.$host.'" /></div></div>';
		$content .= '<input type="hidden" name="op" value="4" />';
		$content .= '<input type="submit" value="Suivant" class="bouton"/>';
		
		break;
	case'1':
	default:
		$_SESSION = array();
		session_destroy();
		if(!class_exists('PDO')) {
			$content .= '<p class="error">Avertissement : Class PDO manquante, vous pouvez mettre &agrave; jour ou continuer avec le risque que certaines tables avec une configuration particulière ne soient pas converties</p><br />';
		}
		$content .= '<p>Avant de continuer, avez-vous fait une sauvegarde de votre base de donn&eacute;es et de votre site</p>';
		$content .= '<p>Si vous choisissez \'NON\', une sauvegarde sera effectu&eacute;e de la base de donn&eacute;es lors du déroulement des op&eacute;rations</p>';
		$content .= '<br />';
		$content .= '<p class="yesno"><input type="radio" name="sauvegarde" value="oui" /> OUI <br />';
		$content .= '<input type="radio" name="sauvegarde" value="non" /> NON <br /></p>';
		$content .= '<input type="hidden" name="op" value="2" />';
		$content .= '<input type="submit" value="Suivant" class="bouton"/>';		
}
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
	   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
<meta charset="UTF-8">
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title>Convert-sql, le convertisseur en UTF-8</title>
<meta name="author" content="CHG-WEB - Cédric MONTUY" />
<link rel="stylesheet" type="text/css" media="all" title="Style sheet" href="style.css" />
</head>
<body>
<form action"index.php" method="post">
<fieldset><?php echo $etape; ?></fieldset>
<br />
<br />
<div class="contenu"><?php echo $content; ?></div>
<br />
<br />
<p> Version : <?php echo $version; ?></p>
</form>
</body>
</html>