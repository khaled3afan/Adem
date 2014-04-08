<?php



/**
 * 
 * @param type $text => text , nums 
 */

function _e($text){
    echo $text;
}
/**
 * 
 * @param type $post POST array ;
 * @return type clear post ;
 */

function clearPOST($post){
    $clear = strip_tags(htmlspecialchars(addslashes($post)));
    return $clear;
}

/**
 * 
 * @param type $get
 * @return type
 */
function clearGET($get){
    $clear = htmlspecialchars(strip_tags($get));
    return $clear;
}

function go($location){
    header("location: $location");
}

function getViewFile($filename,$title){
    $pageTitle = $title;
    $realFile = $filename.".php";
    include "views/".$realFile."";
}

function is_admin(){
    if(isset($_SESSION['admin']) && $_SESSION['admin'] == "yes"){
        
        if(isset($_SESSION['login']) && $_SESSION['login'] == "yes"){
            return TRUE;
        }else{
            return FALSE;
        }
        
    }else{
        return FALSE;
    }
}

function creatCode($num){
    
    $array = array("a","A", "b","B", "c","C", "d","D", "e","E", "f","F", "g","G", "h","H", "i","I", "j","J", "k","K",
        "l","L", "m","M", "n","N", "o","O", "p","P", "q","Q", "r","R", "s","S", "t","T", "u","U", "v","V", "w","W", "x","X", "y","Y", "z","Z");
    $str = array_rand($array,$num);
    foreach ($str as $s){
        $ret .= $array[$s];
    }
    return $ret;
}