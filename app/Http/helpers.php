<?php
 function translite_in_Latin($translitFrom)
    {
    $translitInLatin = array(
    'ы'=>'yii',

    'й'=>'ji',
    'ё'=>'yo',
    'я'=>'ya',
    'щ'=>'shc',
    'ш'=>'sh',
    'я'=>'ea',
    'й'=>'ii',
    'ж'=>'zh',
    'ч'=>'ch',
    'ю'=>'iy',
    'ц'=>'ts',
    'у'=>'u',
    'в'=>'w',
    'в'=>'v',
    'и'=>'i',
    'у'=>'y',
    'д'=>'d',
    'т'=>'t',
    'б'=>'b',
    'п'=>'p',
    'н'=>'n',
    'ф'=>'f',
    'з'=>'z',
    'л'=>'l',
    'к'=>'k',
    'с'=>'c',
    'м'=>'m',
    'р'=>'r',
    'с'=>'s',
    'х'=>'h',
    'ж'=>'j',
    'г'=>'g',
    'а'=>'a',

    );


    $initialString = mb_strtolower($translitFrom, "UTF-8");
    $translited = strtr($initialString, $translitInLatin);

    return $translited;
    }