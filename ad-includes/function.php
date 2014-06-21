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

function is_admin(){
    if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == "TRUE"){
        
        if(isset($_SESSION['logined']) && $_SESSION['logined'] == "TRUE"){
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
        "l","L", "m","M", "n","N", "o","O", "p","P", "q","Q", "r","R", "s","S", "t","T", "u","U", "v","V", "w","W", "x","X", "y","Y", "z","Z",
        "1","2","3","4","5","6","7","8","9");
    $str = array_rand($array,$num);
    $ret = "";
    foreach ($str as $s){
        $ret .= $array[$s];
    }
    return $ret;
}

function is_not_end_slash($from){
    $sub = substr($from,-1,1);
    if($sub == "/"){
        return FALSE;
    }else{
        return TRUE;
    }
}

function is_end_slash($from){
    $sub = substr($from,-1,1);
    if($sub == "/"){
        return TRUE;
    }else{
        return FALSE;
    }
}

function clear_end_slash($from){
    if(is_end_slash($from)){
        $sub = substr($from,0,-1);
        return $sub;
    }else{
        return FALSE;
    }
}

function is_page(){
    $db = new AD_Query;
    $page = clearGET($_REQUEST['page']);
    if(is_end_slash($page)){
        $page = substr($page,0,-1);
    }
    $query = $db->DB_Select("pages",array("where"=>["page_url","=",$page]));
    if($db->DB_Num($query) == 1){
        return TRUE;
    }else{
        return FALSE;
    }
}


function Error($eMsg){
    echo '<!DOCTYPE html>
        <html>
        <head>
            <title>خطأ</title>
            <meta charset="UTF-8">
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <meta name="viewport" content="width=device-width">
        </head>
        <style>
            body {
                 direction:rtl;
            }
            code {
                background : #E9E9E9;
                padding:5px;
                margin:5px;
                color: green;
                border-radius: 5px;
            }
        </style>
        <body dir="rtl">
        <h1 style="color:red">حصل خطأ!</h1>
        <h3>نص الخطأ :</h3>
        <p>'.$eMsg.'</p>
        </body>
        </html>';
    die;
}

function admin_tabs($active_tab){
    ?>
<ul class="nav nav-tabs">
    <?php
    $names = ['index','edit','pages','themes','settings'];
    $titles = ['أهلًا!',"بيانات الواجهة","الصفحات","القوالب","الإعدادات"];
    //$links = [null,'edit.php','pages.php','themes.php','settings.php'];
    if(in_array($active_tab,$names)){
        for($i = 0;$i < count($names);$i++){
            if($names[$i] == $active_tab){
                $li = "<li class='active'>";
            }else{
                $li = "<li>";
            }
            echo $li.'<a href="'.SITE_URL.'/ad-admin/'.$names[$i].'.php">'.$titles[$i].'</a></li>';
        }
    }else{
        die("Error: <code>".__METHOD__."</code> NOT FOUND <code>".$active_tab."</code> in Array OF TABS");
    }
?>
</ul>
    <?php
}