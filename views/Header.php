<?php
//////// GET SITE META ///////////////////////////////////

$Meta = new FrQuery();

/* GET SITE NAME */
$siteName = $Meta->getSettingVal("site_name");

/* GET SITE DESCRIP */
$siteDescrip = $Meta->getSettingVal("site_descrip");

///////////////////////////////////////////////////////////
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php if($pageTitle == "الواجهة" ){
        _e($siteName); _e(" | "); _e($siteDescrip);
        }else{
            _e($pageTitle);
        }
        ?>
        </title>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="<?PHP _e(SITE_URL)?>/cdn/bootstrap/css/bootstrap.css"/>
        <link rel="stylesheet" href="<?PHP _e(SITE_URL)?>/cdn/bootstrap/css/bootstrap-rtl.css"/>
        <script type="text/javascript" src="<?PHP _e(SITE_URL)?>/cdn/js/jquery-2.0.3.js"></script>
        <link rel="stylesheet" href="<?PHP _e(SITE_URL)?>/cdn/css/v3.css"/>
        <meta name="description" content="<?php _e($siteDescrip)?>" />
        <meta name="keywords" content="<?php _e(implode(",",$pageKeyWord));?>" />
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css"/>
        <script type="text/javascript">
            function go(to){
                window.location = to;
            }
        </script>
    </head>
    <body>
        <div class="warp">
            <div class="header">
                <div class="logo">
                    <a href="<?php _e(SITE_URL)?>"><?php _e($siteName) ?></a>
                    <br/>
                    <br/>
                    <span id="description"><?php _e($siteDescrip) ?></span>
                </div>
            </div>