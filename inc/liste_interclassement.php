<?php
/*
	// Fichier pour la conversion de charset d'une base de donnée MySQL
	// Auteur : Cédric MONTUY
	// Date : 07 juillet 2020
	// Version : 2.00
	// Plus de détail : https://github.com/montuy337513/convert_mysql
	// Site internet : store.chg-web.com
*/
$liste_interclassement = '<select name="db_collation" class="form-control" id="db_collation">
    <option value="">Interclassement</option>
    <option value=""></option>
    <optgroup label="armscii8" title="ARMSCII-8 Armenian">
        <option value="armscii8_bin" title="Arménien, Binaire">armscii8_bin</option>
        <option value="armscii8_general_ci" title="Arménien, insensible à la casse">armscii8_general_ci</option>
    </optgroup>
    <optgroup label="ascii" title="US ASCII">
        <option value="ascii_bin" title="Europe de l\'ouest (multilingue), Binaire">ascii_bin</option>
        <option value="ascii_general_ci" title="Europe de l\'ouest (multilingue), insensible à la casse">ascii_general_ci</option>
    </optgroup>
    <optgroup label="big5" title="Big5 Traditional Chinese">
        <option value="big5_bin" title="Chinois traditionnel, Binaire">big5_bin</option>
        <option value="big5_chinese_ci" title="Chinois traditionnel, insensible à la casse">big5_chinese_ci</option>
    </optgroup>
    <optgroup label="binary" title="Binary pseudo charset">
        <option value="binary" title="Binaire">binary</option>
    </optgroup>
    <optgroup label="cp1250" title="Windows Central European">
        <option value="cp1250_bin" title="Europe centrale (multilingue), Binaire">cp1250_bin</option>
        <option value="cp1250_croatian_ci" title="Croate, insensible à la casse">cp1250_croatian_ci</option>
        <option value="cp1250_czech_cs" title="Tchèque, sensible à la casse">cp1250_czech_cs</option>
        <option value="cp1250_general_ci" title="Europe centrale (multilingue), insensible à la casse">cp1250_general_ci</option>
        <option value="cp1250_polish_ci" title="Polonais, insensible à la casse">cp1250_polish_ci</option>
    </optgroup>
    <optgroup label="cp1251" title="Windows Cyrillic">
        <option value="cp1251_bin" title="Cyrillique (multilingue), Binaire">cp1251_bin</option>
        <option value="cp1251_bulgarian_ci" title="Bulgare, insensible à la casse">cp1251_bulgarian_ci</option>
        <option value="cp1251_general_ci" title="Cyrillique (multilingue), insensible à la casse">cp1251_general_ci</option>
        <option value="cp1251_general_cs" title="Cyrillique (multilingue), sensible à la casse">cp1251_general_cs</option>
        <option value="cp1251_ukrainian_ci" title="Ukrainien, insensible à la casse">cp1251_ukrainian_ci</option>
    </optgroup>
    <optgroup label="cp1256" title="Windows Arabic">
        <option value="cp1256_bin" title="Arabe, Binaire">cp1256_bin</option>
        <option value="cp1256_general_ci" title="Arabe, insensible à la casse">cp1256_general_ci</option>
    </optgroup>
    <optgroup label="cp1257" title="Windows Baltic">
        <option value="cp1257_bin" title="Baltique (multilingue), Binaire">cp1257_bin</option>
        <option value="cp1257_general_ci" title="Baltique (multilingue), insensible à la casse">cp1257_general_ci</option>
        <option value="cp1257_lithuanian_ci" title="Lituanien, insensible à la casse">cp1257_lithuanian_ci</option>
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
        <option value="cp866_bin" title="Russe, Binaire">cp866_bin</option>
        <option value="cp866_general_ci" title="Russe, insensible à la casse">cp866_general_ci</option>
    </optgroup>
    <optgroup label="cp932" title="SJIS for Windows Japanese">
        <option value="cp932_bin" title="Japonais, Binaire">cp932_bin</option>
        <option value="cp932_japanese_ci" title="Japonais, insensible à la casse">cp932_japanese_ci</option>
    </optgroup>
    <optgroup label="dec8" title="DEC West European">
        <option value="dec8_bin" title="Europe de l\'ouest (multilingue), Binaire">dec8_bin</option>
        <option value="dec8_swedish_ci" title="Suédois, insensible à la casse">dec8_swedish_ci</option>
    </optgroup>
    <optgroup label="eucjpms" title="UJIS for Windows Japanese">
        <option value="eucjpms_bin" title="Japonais, Binaire">eucjpms_bin</option>
        <option value="eucjpms_japanese_ci" title="Japonais, insensible à la casse">eucjpms_japanese_ci</option>
    </optgroup>
    <optgroup label="euckr" title="EUC-KR Korean">
        <option value="euckr_bin" title="Cor&eacute;en, Binaire">euckr_bin</option>
        <option value="euckr_korean_ci" title="Cor&eacute;en, insensible à la casse">euckr_korean_ci</option>
    </optgroup>
    <optgroup label="gb2312" title="GB2312 Simplified Chinese">
        <option value="gb2312_bin" title="Chinois simplifié, Binaire">gb2312_bin</option>
        <option value="gb2312_chinese_ci" title="Chinois simplifié, insensible à la casse">gb2312_chinese_ci</option>
    </optgroup>
    <optgroup label="gbk" title="GBK Simplified Chinese">
        <option value="gbk_bin" title="Chinois simplifié, Binaire">gbk_bin</option>
        <option value="gbk_chinese_ci" title="Chinois simplifié, insensible à la casse">gbk_chinese_ci</option>
    </optgroup>
    <optgroup label="geostd8" title="GEOSTD8 Georgian">
        <option value="geostd8_bin" title="G&eacute;orgien, Binaire">geostd8_bin</option>
        <option value="geostd8_general_ci" title="G&eacute;orgien, insensible à la casse">geostd8_general_ci</option>
    </optgroup>
    <optgroup label="greek" title="ISO 8859-7 Greek">
        <option value="greek_bin" title="Grec, Binaire">greek_bin</option>
        <option value="greek_general_ci" title="Grec, insensible à la casse">greek_general_ci</option>
    </optgroup>
    <optgroup label="hebrew" title="ISO 8859-8 Hebrew">
        <option value="hebrew_bin" title="H&eacute;breu, Binaire">hebrew_bin</option>
        <option value="hebrew_general_ci" title="H&eacute;breu, insensible à la casse">hebrew_general_ci</option>
    </optgroup>
    <optgroup label="hp8" title="HP West European">
        <option value="hp8_bin" title="Europe de l\'ouest (multilingue), Binaire">hp8_bin</option>
        <option value="hp8_english_ci" title="Anglais, insensible à la casse">hp8_english_ci</option>
    </optgroup>
    <optgroup label="keybcs2" title="DOS Kamenicky Czech-Slovak">
        <option value="keybcs2_bin" title="Tchèque-slovaque, Binaire">keybcs2_bin</option>
        <option value="keybcs2_general_ci" title="Tchèque-slovaque, insensible à la casse">keybcs2_general_ci</option>
    </optgroup>
    <optgroup label="koi8r" title="KOI8-R Relcom Russian">
        <option value="koi8r_bin" title="Russe, Binaire">koi8r_bin</option>
        <option value="koi8r_general_ci" title="Russe, insensible à la casse">koi8r_general_ci</option>
    </optgroup>
    <optgroup label="koi8u" title="KOI8-U Ukrainian">
        <option value="koi8u_bin" title="Ukrainien, Binaire">koi8u_bin</option>
        <option value="koi8u_general_ci" title="Ukrainien, insensible à la casse">koi8u_general_ci</option>
    </optgroup>
        <optgroup label="latin1" title="cp1252 West European">
        <option value="latin1_bin" title="Europe de l\'ouest (multilingue), Binaire">latin1_bin</option>
        <option value="latin1_danish_ci" title="Danois, insensible à la casse">latin1_danish_ci</option>
        <option value="latin1_general_ci" title="Europe de l\'ouest (multilingue), insensible à la casse">latin1_general_ci</option>
        <option value="latin1_general_cs" title="Europe de l\'ouest (multilingue), sensible à la casse">latin1_general_cs</option>
        <option value="latin1_german1_ci" title="Allemand (dictionnaire), insensible à la casse">latin1_german1_ci</option>
        <option value="latin1_german2_ci" title="Allemand (annuaire téléphonique), insensible à la casse">latin1_german2_ci</option>
        <option value="latin1_spanish_ci" title="Espagnol, insensible à la casse">latin1_spanish_ci</option>
        <option value="latin1_swedish_ci" title="Suédois, insensible à la casse">latin1_swedish_ci</option>
    </optgroup>
    <optgroup label="latin2" title="ISO 8859-2 Central European">
        <option value="latin2_bin" title="Europe centrale (multilingue), Binaire">latin2_bin</option>
        <option value="latin2_croatian_ci" title="Croate, insensible à la casse">latin2_croatian_ci</option>
        <option value="latin2_czech_cs" title="Tchèque, sensible à la casse">latin2_czech_cs</option>
        <option value="latin2_general_ci" title="Europe centrale (multilingue), insensible à la casse">latin2_general_ci</option>
        <option value="latin2_hungarian_ci" title="Hongrois, insensible à la casse">latin2_hungarian_ci</option>
    </optgroup>
    <optgroup label="latin5" title="ISO 8859-9 Turkish">
        <option value="latin5_bin" title="Turc, Binaire">latin5_bin</option>
        <option value="latin5_turkish_ci" title="Turc, insensible à la casse">latin5_turkish_ci</option>
    </optgroup>
    <optgroup label="latin7" title="ISO 8859-13 Baltic">
        <option value="latin7_bin" title="Baltique (multilingue), Binaire">latin7_bin</option>
        <option value="latin7_estonian_cs" title="Estonien, sensible à la casse">latin7_estonian_cs</option>
        <option value="latin7_general_ci" title="Baltique (multilingue), insensible à la casse">latin7_general_ci</option>
        <option value="latin7_general_cs" title="Baltique (multilingue), sensible à la casse">latin7_general_cs</option>
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
        <option value="sjis_bin" title="Japonais, Binaire">sjis_bin</option>
        <option value="sjis_japanese_ci" title="Japonais, insensible à la casse">sjis_japanese_ci</option>
    </optgroup>
    <optgroup label="swe7" title="7bit Swedish">
        <option value="swe7_bin" title="Suédois, Binaire">swe7_bin</option>
        <option value="swe7_swedish_ci" title="Suédois, insensible à la casse">swe7_swedish_ci</option>
    </optgroup>
    <optgroup label="tis620" title="TIS620 Thai">
        <option value="tis620_bin" title="Tha&iuml;, Binaire">tis620_bin</option>
        <option value="tis620_thai_ci" title="Tha&iuml;, insensible à la casse">tis620_thai_ci</option>
    </optgroup>
        <optgroup label="ucs2" title="UCS-2 Unicode">
        <option value="ucs2_bin" title="Unicode (multilingue), Binaire">ucs2_bin</option>
        <option value="ucs2_croatian_ci" title="Croate, insensible à la casse">ucs2_croatian_ci</option>
        <option value="ucs2_croatian_mysql561_ci" title="Croate">ucs2_croatian_mysql561_ci</option>
        <option value="ucs2_czech_ci" title="Tchèque, insensible à la casse">ucs2_czech_ci</option>
        <option value="ucs2_danish_ci" title="Danois, insensible à la casse">ucs2_danish_ci</option>
        <option value="ucs2_esperanto_ci" title="Espéranto, insensible à la casse">ucs2_esperanto_ci</option>
        <option value="ucs2_estonian_ci" title="Estonien, insensible à la casse">ucs2_estonian_ci</option>
        <option value="ucs2_general_ci" title="Unicode (multilingue), insensible à la casse">ucs2_general_ci</option>
        <option value="ucs2_general_mysql500_ci" title="Unicode (multilingue)">ucs2_general_mysql500_ci</option>
        <option value="ucs2_german2_ci" title="Allemand (annuaire téléphonique), insensible à la casse">ucs2_german2_ci</option>
        <option value="ucs2_hungarian_ci" title="Hongrois, insensible à la casse">ucs2_hungarian_ci</option>
        <option value="ucs2_icelandic_ci" title="Islandais, insensible à la casse">ucs2_icelandic_ci</option>
        <option value="ucs2_latvian_ci" title="Letton, insensible à la casse">ucs2_latvian_ci</option>
        <option value="ucs2_lithuanian_ci" title="Lituanien, insensible à la casse">ucs2_lithuanian_ci</option>
        <option value="ucs2_myanmar_ci" title="inconnu, insensible à la casse">ucs2_myanmar_ci</option>
        <option value="ucs2_persian_ci" title="Farsi, insensible à la casse">ucs2_persian_ci</option>
        <option value="ucs2_polish_ci" title="Polonais, insensible à la casse">ucs2_polish_ci</option>
        <option value="ucs2_roman_ci" title="Europe de l\'ouest, insensible à la casse">ucs2_roman_ci</option>
        <option value="ucs2_romanian_ci" title="Roumain, insensible à la casse">ucs2_romanian_ci</option>
        <option value="ucs2_sinhala_ci" title="Cingalais, insensible à la casse">ucs2_sinhala_ci</option>
        <option value="ucs2_slovak_ci" title="Slovaque, insensible à la casse">ucs2_slovak_ci</option>
        <option value="ucs2_slovenian_ci" title="Slovène, insensible à la casse">ucs2_slovenian_ci</option>
        <option value="ucs2_spanish2_ci" title="Espagnol traditionnel, insensible à la casse">ucs2_spanish2_ci</option>
        <option value="ucs2_spanish_ci" title="Espagnol, insensible à la casse">ucs2_spanish_ci</option>
        <option value="ucs2_swedish_ci" title="Suédois, insensible à la casse">ucs2_swedish_ci</option>
        <option value="ucs2_thai_520_w2" title="Tha&iuml;">ucs2_thai_520_w2</option>
        <option value="ucs2_turkish_ci" title="Turc, insensible à la casse">ucs2_turkish_ci</option>
        <option value="ucs2_unicode_520_ci" title="Unicode (multilingue)">ucs2_unicode_520_ci</option>
        <option value="ucs2_unicode_ci" title="Unicode (multilingue), insensible à la casse">ucs2_unicode_ci</option>
        <option value="ucs2_vietnamese_ci" title="Vietnamien, insensible à la casse">ucs2_vietnamese_ci</option>
    </optgroup>
    <optgroup label="ujis" title="EUC-JP Japanese">
        <option value="ujis_bin" title="Japonais, Binaire">ujis_bin</option>
        <option value="ujis_japanese_ci" title="Japonais, insensible à la casse">ujis_japanese_ci</option>
    </optgroup>
    <optgroup label="utf16" title="UTF-16 Unicode">
        <option value="utf16_bin" title="inconnu, Binaire">utf16_bin</option>
        <option value="utf16_croatian_ci" title="Croate, insensible à la casse">utf16_croatian_ci</option>
        <option value="utf16_croatian_mysql561_ci" title="Croate">utf16_croatian_mysql561_ci</option>
        <option value="utf16_czech_ci" title="Tchèque, insensible à la casse">utf16_czech_ci</option>
        <option value="utf16_danish_ci" title="Danois, insensible à la casse">utf16_danish_ci</option>
        <option value="utf16_esperanto_ci" title="Espéranto, insensible à la casse">utf16_esperanto_ci</option>
        <option value="utf16_estonian_ci" title="Estonien, insensible à la casse">utf16_estonian_ci</option>
        <option value="utf16_general_ci" title="inconnu, insensible à la casse">utf16_general_ci</option>
        <option value="utf16_german2_ci" title="Allemand (annuaire téléphonique), insensible à la casse">utf16_german2_ci</option>
        <option value="utf16_hungarian_ci" title="Hongrois, insensible à la casse">utf16_hungarian_ci</option>
        <option value="utf16_icelandic_ci" title="Islandais, insensible à la casse">utf16_icelandic_ci</option>
        <option value="utf16_latvian_ci" title="Letton, insensible à la casse">utf16_latvian_ci</option>
        <option value="utf16_lithuanian_ci" title="Lituanien, insensible à la casse">utf16_lithuanian_ci</option>
        <option value="utf16_myanmar_ci" title="inconnu, insensible à la casse">utf16_myanmar_ci</option>
        <option value="utf16_persian_ci" title="Farsi, insensible à la casse">utf16_persian_ci</option>
        <option value="utf16_polish_ci" title="Polonais, insensible à la casse">utf16_polish_ci</option>
        <option value="utf16_roman_ci" title="Europe de l\'ouest, insensible à la casse">utf16_roman_ci</option>
        <option value="utf16_romanian_ci" title="Roumain, insensible à la casse">utf16_romanian_ci</option>
        <option value="utf16_sinhala_ci" title="Cingalais, insensible à la casse">utf16_sinhala_ci</option>
        <option value="utf16_slovak_ci" title="Slovaque, insensible à la casse">utf16_slovak_ci</option>
        <option value="utf16_slovenian_ci" title="Slovène, insensible à la casse">utf16_slovenian_ci</option>
        <option value="utf16_spanish2_ci" title="Espagnol traditionnel, insensible à la casse">utf16_spanish2_ci</option>
        <option value="utf16_spanish_ci" title="Espagnol, insensible à la casse">utf16_spanish_ci</option>
        <option value="utf16_swedish_ci" title="Suédois, insensible à la casse">utf16_swedish_ci</option>
        <option value="utf16_thai_520_w2" title="Tha&iuml;">utf16_thai_520_w2</option>
        <option value="utf16_turkish_ci" title="Turc, insensible à la casse">utf16_turkish_ci</option>
        <option value="utf16_unicode_520_ci" title="Unicode (multilingue)">utf16_unicode_520_ci</option>
        <option value="utf16_unicode_ci" title="Unicode (multilingue), insensible à la casse">utf16_unicode_ci</option>
        <option value="utf16_vietnamese_ci" title="Vietnamien, insensible à la casse">utf16_vietnamese_ci</option>
    </optgroup>
    <optgroup label="utf16le" title="UTF-16LE Unicode">
        <option value="utf16le_bin" title="inconnu, Binaire">utf16le_bin</option>
        <option value="utf16le_general_ci" title="inconnu, insensible à la casse">utf16le_general_ci</option>
    </optgroup>
    <optgroup label="utf32" title="UTF-32 Unicode">
        <option value="utf32_bin" title="inconnu, Binaire">utf32_bin</option>
        <option value="utf32_croatian_ci" title="Croate, insensible à la casse">utf32_croatian_ci</option>
        <option value="utf32_croatian_mysql561_ci" title="Croate">utf32_croatian_mysql561_ci</option>
        <option value="utf32_czech_ci" title="Tchèque, insensible à la casse">utf32_czech_ci</option>
        <option value="utf32_danish_ci" title="Danois, insensible à la casse">utf32_danish_ci</option>
        <option value="utf32_esperanto_ci" title="Espéranto, insensible à la casse">utf32_esperanto_ci</option>
        <option value="utf32_estonian_ci" title="Estonien, insensible à la casse">utf32_estonian_ci</option>
        <option value="utf32_general_ci" title="inconnu, insensible à la casse">utf32_general_ci</option>
        <option value="utf32_german2_ci" title="Allemand (annuaire téléphonique), insensible à la casse">utf32_german2_ci</option>
        <option value="utf32_hungarian_ci" title="Hongrois, insensible à la casse">utf32_hungarian_ci</option>
        <option value="utf32_icelandic_ci" title="Islandais, insensible à la casse">utf32_icelandic_ci</option>
        <option value="utf32_latvian_ci" title="Letton, insensible à la casse">utf32_latvian_ci</option>
        <option value="utf32_lithuanian_ci" title="Lituanien, insensible à la casse">utf32_lithuanian_ci</option>
        <option value="utf32_myanmar_ci" title="inconnu, insensible à la casse">utf32_myanmar_ci</option>
        <option value="utf32_persian_ci" title="Farsi, insensible à la casse">utf32_persian_ci</option>
        <option value="utf32_polish_ci" title="Polonais, insensible à la casse">utf32_polish_ci</option>
        <option value="utf32_roman_ci" title="Europe de l\'ouest, insensible à la casse">utf32_roman_ci</option>
        <option value="utf32_romanian_ci" title="Roumain, insensible à la casse">utf32_romanian_ci</option>
        <option value="utf32_sinhala_ci" title="Cingalais, insensible à la casse">utf32_sinhala_ci</option>
        <option value="utf32_slovak_ci" title="Slovaque, insensible à la casse">utf32_slovak_ci</option>
        <option value="utf32_slovenian_ci" title="Slovène, insensible à la casse">utf32_slovenian_ci</option>
        <option value="utf32_spanish2_ci" title="Espagnol traditionnel, insensible à la casse">utf32_spanish2_ci</option>
        <option value="utf32_spanish_ci" title="Espagnol, insensible à la casse">utf32_spanish_ci</option>
        <option value="utf32_swedish_ci" title="Suédois, insensible à la casse">utf32_swedish_ci</option>
        <option value="utf32_thai_520_w2" title="Tha&iuml;">utf32_thai_520_w2</option>
        <option value="utf32_turkish_ci" title="Turc, insensible à la casse">utf32_turkish_ci</option>
        <option value="utf32_unicode_520_ci" title="Unicode (multilingue)">utf32_unicode_520_ci</option>
        <option value="utf32_unicode_ci" title="Unicode (multilingue), insensible à la casse">utf32_unicode_ci</option>
        <option value="utf32_vietnamese_ci" title="Vietnamien, insensible à la casse">utf32_vietnamese_ci</option>
    </optgroup>
    <optgroup label="utf8" title="UTF-8 Unicode">
        <option value="utf8_bin" title="Unicode (multilingue), Binaire">utf8_bin</option>
        <option value="utf8_croatian_ci" title="Croate, insensible à la casse">utf8_croatian_ci</option>
        <option value="utf8_croatian_mysql561_ci" title="Croate">utf8_croatian_mysql561_ci</option>
        <option value="utf8_czech_ci" title="Tchèque, insensible à la casse">utf8_czech_ci</option>
        <option value="utf8_danish_ci" title="Danois, insensible à la casse">utf8_danish_ci</option>
        <option value="utf8_esperanto_ci" title="Espéranto, insensible à la casse">utf8_esperanto_ci</option>
        <option value="utf8_estonian_ci" title="Estonien, insensible à la casse">utf8_estonian_ci</option>
        <option value="utf8_general_ci" title="Unicode (multilingue), insensible à la casse" >utf8_general_ci</option>
        <option value="utf8_general_mysql500_ci" title="Unicode (multilingue)">utf8_general_mysql500_ci</option>
        <option value="utf8_german2_ci" title="Allemand (annuaire téléphonique), insensible à la casse">utf8_german2_ci</option>
        <option value="utf8_hungarian_ci" title="Hongrois, insensible à la casse">utf8_hungarian_ci</option>
        <option value="utf8_icelandic_ci" title="Islandais, insensible à la casse">utf8_icelandic_ci</option>
        <option value="utf8_latvian_ci" title="Letton, insensible à la casse">utf8_latvian_ci</option>
        <option value="utf8_lithuanian_ci" title="Lituanien, insensible à la casse">utf8_lithuanian_ci</option>
        <option value="utf8_myanmar_ci" title="inconnu, insensible à la casse">utf8_myanmar_ci</option>
        <option value="utf8_persian_ci" title="Farsi, insensible à la casse">utf8_persian_ci</option>
        <option value="utf8_polish_ci" title="Polonais, insensible à la casse">utf8_polish_ci</option>
        <option value="utf8_roman_ci" title="Europe de l\'ouest, insensible à la casse">utf8_roman_ci</option>
        <option value="utf8_romanian_ci" title="Roumain, insensible à la casse">utf8_romanian_ci</option>
        <option value="utf8_sinhala_ci" title="Cingalais, insensible à la casse">utf8_sinhala_ci</option>
        <option value="utf8_slovak_ci" title="Slovaque, insensible à la casse">utf8_slovak_ci</option>
        <option value="utf8_slovenian_ci" title="Slovène, insensible à la casse">utf8_slovenian_ci</option>
        <option value="utf8_spanish2_ci" title="Espagnol traditionnel, insensible à la casse">utf8_spanish2_ci</option>
        <option value="utf8_spanish_ci" title="Espagnol, insensible à la casse">utf8_spanish_ci</option>
        <option value="utf8_swedish_ci" title="Suédois, insensible à la casse">utf8_swedish_ci</option>
        <option value="utf8_thai_520_w2" title="Tha&iuml;">utf8_thai_520_w2</option>
        <option value="utf8_turkish_ci" title="Turc, insensible à la casse">utf8_turkish_ci</option>
        <option value="utf8_unicode_520_ci" title="Unicode (multilingue)">utf8_unicode_520_ci</option>
        <option value="utf8_unicode_ci" title="Unicode (multilingue), insensible à la casse">utf8_unicode_ci</option>
        <option value="utf8_vietnamese_ci" title="Vietnamien, insensible à la casse">utf8_vietnamese_ci</option>
    </optgroup>
    <optgroup label="utf8mb4" title="UTF-8 Unicode">
        <option value="utf8mb4_bin" title="Unicode (multilingue), Binaire">utf8mb4_bin</option>
        <option value="utf8mb4_croatian_ci" title="Croate, insensible à la casse">utf8mb4_croatian_ci</option>
        <option value="utf8mb4_croatian_mysql561_ci" title="Croate">utf8mb4_croatian_mysql561_ci</option>
        <option value="utf8mb4_czech_ci" title="Tchèque, insensible à la casse">utf8mb4_czech_ci</option>
        <option value="utf8mb4_danish_ci" title="Danois, insensible à la casse">utf8mb4_danish_ci</option>
        <option value="utf8mb4_esperanto_ci" title="Espéranto, insensible à la casse">utf8mb4_esperanto_ci</option>
        <option value="utf8mb4_estonian_ci" title="Estonien, insensible à la casse">utf8mb4_estonian_ci</option>
        <option value="utf8mb4_general_ci" title="Unicode (multilingue), insensible à la casse">utf8mb4_general_ci</option>
        <option value="utf8mb4_german2_ci" title="Allemand (annuaire téléphonique), insensible à la casse">utf8mb4_german2_ci</option>
        <option value="utf8mb4_hungarian_ci" title="Hongrois, insensible à la casse">utf8mb4_hungarian_ci</option>
        <option value="utf8mb4_icelandic_ci" title="Islandais, insensible à la casse">utf8mb4_icelandic_ci</option>
        <option value="utf8mb4_latvian_ci" title="Letton, insensible à la casse">utf8mb4_latvian_ci</option>
        <option value="utf8mb4_lithuanian_ci" title="Lituanien, insensible à la casse">utf8mb4_lithuanian_ci</option>
        <option value="utf8mb4_myanmar_ci" title="inconnu, insensible à la casse">utf8mb4_myanmar_ci</option>
        <option value="utf8mb4_persian_ci" title="Farsi, insensible à la casse">utf8mb4_persian_ci</option>
        <option value="utf8mb4_polish_ci" title="Polonais, insensible à la casse">utf8mb4_polish_ci</option>
        <option value="utf8mb4_roman_ci" title="Europe de l\'ouest, insensible à la casse">utf8mb4_roman_ci</option>
        <option value="utf8mb4_romanian_ci" title="Roumain, insensible à la casse">utf8mb4_romanian_ci</option>
        <option value="utf8mb4_sinhala_ci" title="Cingalais, insensible à la casse">utf8mb4_sinhala_ci</option>
        <option value="utf8mb4_slovak_ci" title="Slovaque, insensible à la casse">utf8mb4_slovak_ci</option>
        <option value="utf8mb4_slovenian_ci" title="Slovène, insensible à la casse">utf8mb4_slovenian_ci</option>
        <option value="utf8mb4_spanish2_ci" title="Espagnol traditionnel, insensible à la casse">utf8mb4_spanish2_ci</option>
        <option value="utf8mb4_spanish_ci" title="Espagnol, insensible à la casse">utf8mb4_spanish_ci</option>
        <option value="utf8mb4_swedish_ci" title="Suédois, insensible à la casse">utf8mb4_swedish_ci</option>
        <option value="utf8mb4_thai_520_w2" title="Tha&iuml;">utf8mb4_thai_520_w2</option>
        <option value="utf8mb4_turkish_ci" title="Turc, insensible à la casse">utf8mb4_turkish_ci</option>
        <option value="utf8mb4_unicode_520_ci" title="Unicode (multilingue)">utf8mb4_unicode_520_ci</option>
        <option value="utf8mb4_unicode_ci" title="Unicode (multilingue), insensible à la casse" selected="selected">utf8mb4_unicode_ci</option>
        <option value="utf8mb4_vietnamese_ci" title="Vietnamien, insensible à la casse">utf8mb4_vietnamese_ci</option>
    </optgroup>
</select>';
$table_interclassement = array(
    "armscii8_bin",
    "armscii8_general_ci",
    "ascii_bin",
    "ascii_general_ci",
    "big5_bin",
    "big5_chinese_ci",
    "binary",
    "cp1250_bin",
    "cp1250_croatian_ci",
    "cp1250_czech_cs",
    "cp1250_general_ci",
    "cp1250_polish_ci",
    "cp1251_bin","cp1251_bulgarian_ci",
    "cp1251_general_ci",
    "cp1251_general_cs",
    "cp1251_ukrainian_ci",
    "cp1256_bin",
    "cp1256_general_ci",
    "cp1257",
    "cp1257_bin",
    "cp1257_general_ci",
    "cp1257_lithuanian_ci",
    "cp850_bin",
    "cp850_general_ci",
    "cp852_bin",
    "cp852_general_ci",
    "cp866_bin",
    "cp866_general_ci",
    "cp932_bin",
    "cp932_japanese_ci",
    "dec8_bin",
    "dec8_swedish_ci",
    "eucjpms_bin",
    "eucjpms_japanese_ci" ,
    "euckr_bin",
    "euckr_korean_ci",
    "gb2312_bin",
    "gb2312_chinese_ci",
    "gbk_bin",
    "gbk_chinese_ci",
    "geostd8_bin",
    "geostd8_general_ci",
    "greek_bin",
    "greek_general_ci",
    "hebrew_bin",
    "hebrew_general_ci",
    "hp8_bin",
    "hp8_english_ci",
    "keybcs2_bin",
    "keybcs2_general_ci",
    "koi8r_bin",
    "koi8r_general_ci",
    "koi8u_bin",
    "koi8u_general_ci",
    "latin1_bin",
    "latin1_danish_ci",
    "latin1_general_ci",
    "latin1_general_cs",
    "latin1_german1_ci",
    "latin1_german2_ci",
    "latin1_spanish_ci",
    "latin1_swedish_ci",
    "latin2_bin",
    "latin2_croatian_ci",
    "latin2_czech_cs" ,
    "latin2_general_ci",
    "latin2_hungarian_ci",
    "latin5_bin",
    "latin5_turkish_ci",
    "latin7_bin",
    "latin7_estonian_cs",
    "latin7_general_ci",
    "latin7_general_cs",
    "macce_bin",
    "macce_general_ci",
    "macroman_bin",
    "macroman_general_ci",
    "sjis_bin",
    "sjis_japanese_ci",
    "swe7_bin",
    "swe7_swedish_ci",
    "tis620_bin",
    "tis620_thai_ci",
    "ucs2_bin",
    "ucs2_croatian_ci",
    "ucs2_croatian_mysql561_ci",
    "ucs2_czech_ci",
    "ucs2_danish_ci",
    "ucs2_esperanto_ci",
    "ucs2_estonian_ci",
    "ucs2_general_ci",
    "ucs2_general_mysql500_ci",
    "ucs2_german2_ci",
    "ucs2_hungarian_ci",
    "ucs2_icelandic_ci",
    "ucs2_latvian_ci",
    "ucs2_lithuanian_ci",
    "ucs2_myanmar_ci",
    "ucs2_persian_ci",
    "ucs2_polish_ci",
    "ucs2_roman_ci",
    "ucs2_romanian_ci",
    "ucs2_sinhala_ci",
    "ucs2_slovak_ci",
    "ucs2_slovenian_ci",
    "ucs2_spanish2_ci",
    "ucs2_spanish_ci",
    "ucs2_swedish_ci",
    "ucs2_thai_520_w2",
    "ucs2_turkish_ci",
    "ucs2_unicode_520_ci",
    "ucs2_unicode_ci",
    "ucs2_vietnamese_ci",
    "ujis_bin",
    "ujis_japanese_ci",
    "utf16_bin",
    "utf16_croatian_ci",
    "utf16_croatian_mysql561_ci",
    "utf16_czech_ci",
    "utf16_danish_ci",
    "utf16_esperanto_ci",
    "utf16_estonian_ci",
    "utf16_general_ci",
    "utf16_german2_ci",
    "utf16_hungarian_ci",
    "utf16_icelandic_ci",
    "utf16_latvian_ci",
    "utf16_lithuanian_ci",
    "utf16_myanmar_ci",
    "utf16_persian_ci",
    "utf16_polish_ci",
    "utf16_roman_ci",
    "utf16_romanian_ci",
    "utf16_sinhala_ci",
    "utf16_slovak_ci",
    "utf16_slovenian_ci",
    "utf16_spanish2_ci",
    "utf16_spanish_ci",
    "utf16_swedish_ci",
    "utf16_thai_520_w2",
    "utf16_turkish_ci",
    "utf16_unicode_520_ci",
    "utf16_unicode_ci",
    "utf16_vietnamese_ci",
    "utf16le_bin",
    "utf32_bin",
    "utf32_croatian_ci",
    "utf32_croatian_mysql561_ci",
    "utf32_czech_ci",
    "utf32_danish_ci",
    "utf32_esperanto_ci",
    "utf32_estonian_ci",
    "utf32_general_ci",
    "utf32_german2_ci",
    "utf32_hungarian_ci",
    "utf32_icelandic_ci",
    "utf32_latvian_ci",
    "utf32_lithuanian_ci",
    "utf32_myanmar_ci",
    "utf32_persian_ci",
    "utf32_polish_ci",
    "utf32_roman_ci",
    "utf32_romanian_ci",
    "utf32_sinhala_ci",
    "utf32_slovak_ci",
    "utf32_slovenian_ci",
    "utf32_spanish2_ci",
    "utf32_spanish_ci",
    "utf32_swedish_ci",
    "utf32_thai_520_w2",
    "utf32_turkish_ci",
    "utf32_unicode_520_ci",
    "utf32_unicode_ci",
    "utf32_vietnamese_ci",
    "utf8_bin",
    "utf8_croatian_ci",
    "utf8_croatian_mysql561_ci",
    "utf8_czech_ci",
    "utf8_danish_ci",
    "utf8_esperanto_ci",
    "utf8_estonian_ci",
    "utf8_general_ci",
    "utf8_general_mysql500_ci",
    "utf8_german2_ci",
    "utf8_hungarian_ci",
    "utf8_icelandic_ci",
    "utf8_latvian_ci",
    "utf8_lithuanian_ci",
    "utf8_myanmar_ci",
    "utf8_persian_ci",
    "utf8_polish_ci",
    "utf8_roman_ci",
    "utf8_romanian_ci",
    "utf8_sinhala_ci",
    "utf8_slovak_ci",
    "utf8_slovenian_ci",
    "utf8_spanish2_ci",
    "utf8_spanish_ci",
    "utf8_swedish_ci",
    "utf8_thai_520_w2",
    "utf8_turkish_ci",
    "utf8_unicode_520_ci",
    "utf8_unicode_ci",
    "utf8_vietnamese_ci",
    "utf8mb4_bin",
    "utf8mb4_croatian_ci",
    "utf8mb4_croatian_mysql561_ci",
    "utf8mb4_czech_ci",
    "utf8mb4_danish_ci",
    "utf8mb4_esperanto_ci",
    "utf8mb4_estonian_ci",
    "utf8mb4_general_ci",
    "utf8mb4_german2_ci",
    "utf8mb4_hungarian_ci",
    "utf8mb4_icelandic_ci",
    "utf8mb4_latvian_ci",
    "utf8mb4_lithuanian_ci",
    "utf8mb4_myanmar_ci",
    "utf8mb4_persian_ci",
    "utf8mb4_polish_ci",
    "utf8mb4_roman_ci",
    "utf8mb4_romanian_ci",
    "utf8mb4_sinhala_ci",
    "utf8mb4_slovak_ci",
    "utf8mb4_slovenian_ci",
    "utf8mb4_spanish2_ci",
    "utf8mb4_spanish_ci",
    "utf8mb4_swedish_ci",
    "utf8mb4_thai_520_w2",
    "utf8mb4_turkish_ci",
    "utf8mb4_unicode_520_ci",
    "utf8mb4_unicode_ci",
    "utf8mb4_vietnamese_ci"
);