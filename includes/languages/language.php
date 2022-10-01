<?php

// include languages files
include "arabic.php";
include "english.php";
/**
 * 
 */
function language($phrase, $lang = "ar") {
    // return the word
    // return $lang == "en" ?  languageEn($phrase) : languageAr($phrase);
    return languageAr($phrase);
}
