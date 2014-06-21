<?php
/**
 * =======================
 * Adem Web application!
 * -- Theme System .
 * =======================
 * @package Adem - Themes System
 * @category Tempalte Functions
 * @author Fares AlBelady
 * @since 0.5.2
 * @version 0.3
 * 
 * @NOTE : All Template Functions will be like this ( TMPL_FunctionName ) .
 */


/*
 * ==============================================
 * Global Classes cuz use it in Template Functions 
 * ==============================================
 */
$TMPL_Query = new AD_Query;
$TMPL_Folders = new AD_Folders;
$GLOBALS['TMPL_Query'] = $TMPL_Query;
$GLOBALS['TMPL_Folders'] = $TMPL_Folders;

$THEME_Files = $TMPL_Folders->getFiles(ASB_PATH.DIRECTORY_SEPARATOR."ad-content".DIRECTORY_SEPARATOR."ad-themes"
            .DIRECTORY_SEPARATOR.THEME_NAME.DIRECTORY_SEPARATOR);
$GLOBALS['THEME_Files'] = $THEME_Files;

/**
 * ======================
 * Site INFO Functions
 * ======================
 * @global AD_Query $TMPL_Query
 * @return Text echo INFO value
 * 
 * @NOTE : All Site INFO Functions will be like this ( TMPL_SiteINFONAME ) .
 */

function TMPL_SiteName(){
    global $TMPL_Query;
    $siteName = $TMPL_Query->getSettingVal("site_name");
    echo $siteName;
}

function TMPL_SiteTitle($between = null,$printDes = null){
    $between = is_null($between) ? " | " : $between;
    $printDes = is_null($printDes) ? true : false;
    global $pTitle;
    switch($pTitle):
        case "index":
            TMPL_SiteName();
            if($printDes){echo " ".$between." ";TMPL_SiteDescrip();}
            break;
        case "pages":
            TMPL_SiteName();echo " ".$between." ";TMPL_PageTitle();
            break;
        case "404":
            echo "خطأ ! ، تعذر إيجاد الصفحة .";
            break;
        
        // next versions
        case "works":
            break;
        case "work":
            break;
        case "posts":
            break;
        case "post":
            break;
    endswitch;
}

function TMPL_SiteDescrip(){
    global $TMPL_Query;
    $des = $TMPL_Query->getSettingVal("site_descrip");
    echo $des;
}

function TMPL_SiteKeywords(){
    global $TMPL_Query;
    $key = $TMPL_Query->getSettingVal("site_keywords");
    echo $key;
}


function TMPL_ThemeUrl($echo = null){
    $echo = is_null($echo) ? true : false;
    if($echo){
        echo THEME_FOLDER;
    }else{
        return THEME_FOLDER;
    }
}

function TMPL_SiteUrl($echo = null){
    $echo = is_null($echo) ? true : false;
    if($echo){
        echo SITE_URL;
    }else{
        return SITE_URL;
    }
}

function TMPL_Keywords(){
    global $pTitle;
    switch($pTitle):
        case "index":
            TMPL_SiteKeywords();
            break;
        case "pages":
            TMPL_PageKeywords();
            break;
        case "404":
            echo null;
            break;
        
        // next versions
        case "works":
            break;
        case "posts":
            break;
    endswitch;
}


function TMPL_Descrip(){
    global $pTitle;
    switch($pTitle):
        case "index":
            TMPL_SiteDescrip();
            break;
        case "pages":
            TMPL_PageDescrip();
            break;
        case "404":
            echo null;
            break;
        
        // next versions
        case "works":
            break;
        case "posts":
            break;
    endswitch;
}

/**
 * ======================
 * Get Header & Footer
 * ======================
 * @global type $AD_Query
 * @return void inculde Header & Footer Files FROM THEME FOLDER!
 */
function TMPL_getHeader(){
    global $AD_Query;
    global $THEME_Files;
    $pTitle = $GLOBALS['pTitle'];
    $pDes = $GLOBALS['pDes'];
    $pKey = $GLOBALS['pKey'];
    if(in_array("header.php",$THEME_Files)){
       include ASB_PATH.DIRECTORY_SEPARATOR."ad-content".DIRECTORY_SEPARATOR."ad-themes"
            .DIRECTORY_SEPARATOR.THEME_NAME.DIRECTORY_SEPARATOR."header.php";
    }else{
        Error("تعذر الوصول لملف <code>header.php</code>");
    }
}

function TMPL_getFooter(){
    global $AD_Query;
    global $THEME_Files;
    if(in_array("footer.php",$THEME_Files)){
       include ASB_PATH.DIRECTORY_SEPARATOR."ad-content".DIRECTORY_SEPARATOR."ad-themes"
            .DIRECTORY_SEPARATOR.THEME_NAME.DIRECTORY_SEPARATOR."footer.php";
    }else{
        Error("تعذر الوصول لملف <code>footer.php</code>");
    }
    
}

function TMPL_getComments(){
    global $AD_Query;
    global $THEME_Files;
    if(in_array("footer.php",$THEME_Files)){
       include ASB_PATH.DIRECTORY_SEPARATOR."ad-content".DIRECTORY_SEPARATOR."ad-themes"
            .DIRECTORY_SEPARATOR.THEME_NAME.DIRECTORY_SEPARATOR."comments.php";
    }else{
        Error("تعذر الوصول لملف <code>comments.php</code>");
    }
    
}

/**
 * ============================
 * SOCIAL FUNCTIONS!
 * ============================
 * @global AD_Query $TMPL_Query
 * @return void (SOCIAL NAME URL)
 * 
 * @NOTE : All Social Functions will be like this ( TMPL_getSOCIALNAME )
 *  
 */

function TMPL_getTwitter(){
    global $TMPL_Query;
    $get = $TMPL_Query->getSocial("twitter");
    return $get;
}

function TMPL_getFacebook(){
    global $TMPL_Query;
    $get = $TMPL_Query->getSocial("facebook");
    return $get;
}

function TMPL_getTumblr(){
    global $TMPL_Query;
    $get = $TMPL_Query->getSocial("tumblr");
    return $get;;
}

function TMPL_getGitHub(){
    global $TMPL_Query;
    $get = $TMPL_Query->getSocial("github");
    return $get;;
}

function TMPL_getGooglePlus(){
    global $TMPL_Query;
    $get = $TMPL_Query->getSocial("google-plus");
    return $get;;
}

function TMPL_getInstagram(){
    global $TMPL_Query;
    $get = $TMPL_Query->getSocial("instagram");
    return $get;
}

function TMPL_getSkype(){
    global $TMPL_Query;
    $get = $TMPL_Query->getSocial("skype");
    return $get;
}

function TMPL_getYouTube(){
    global $TMPL_Query;
    $get = $TMPL_Query->getSocial("youtube");
    return $get;
}

function TMPL_getGoogleCode(){
    global $TMPL_Query;
    $getCode = $TMPL_Query->getSettingVal('google_code');
    if(isset($getCode) && !empty($getCode)){
        echo $getCode;
    }else{
        return FALSE;
    }
}
/**
 * ============================
 * Pages FUNCTIONS!
 * ============================
 * @global AD_Query $TMPL_Query
 * @return void
 * 
 * @NOTE : All PAGE Functions will be like this ( TMPL_PageFUNCTION ) 
 */

function TMPL_PageTitle() {
    global $page_info;
    echo $page_info['page_title'];
}

function TMPL_PageKeywords(){
    global $page_info;
    echo $page_info['page_keyword'];
}

function TMPL_PageDescrip(){
    global $page_info;
    echo $page_info['page_Des'];
}

function TMPL_PageUrl(){
    global $page_info;
    echo SITE_URL."/page/".$page_info['page_url'];
}

function TMPL_PageContent(){
    global $page_info;
    echo stripcslashes($page_info['page_content']);
}

function TMPL_PageDate(){
    global $page_info;
    echo $page_info['page_date'];
}

/** Comments will support in v0.5.3 , SOON! **/
function TMPL_PageAllowComments(){
    global $page_info;
    if($page_info['allow_comments'] == 1){
        return true;
    }else{
        return false;
    }
}

function TMPL_PageID(){
    global $page_info;
    return $page_info['page_id'];
}