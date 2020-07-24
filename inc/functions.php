<?php
/*
	// Fichier pour la conversion de charset d'une base de donnée MySQL
	// Auteur : Cédric MONTUY
	// Date : 07 juillet 2020
	// Version : 2.00
	// Plus de détail : https://github.com/montuy337513/convert_mysql
	// Site internet : store.chg-web.com
*/

function test_cle($var){
    if (strpos($var,'.key') !== false){
        return $var;
    }
}
function test_conf($var){
    if (strpos($var,'.conf') !== false){
        return $var;
    }
}
function test_tache($var){
    if (strpos($var,'.tache') !== false){
        return $var;
    }
}
// Compatibilté avec les versions antérieurs à PHP 7.3
if (!function_exists('array_key_first')) {
    function array_key_first(array $arr) {
        foreach($arr as $key => $unused) {
            return $key;
        }
        return NULL;
    }
}