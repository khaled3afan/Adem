<?php
$db = new AD_Query;
/* GET SITE NAME */
$siteName = $db->getSettingVal("site_name");

/* GET SITE DESCRIP */
$siteDescrip = $db->getSettingVal("site_descrip");

///////////////////////////////////////////////////////////
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php _e($pTitle) ?></title>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="<?PHP _e(SITE_URL)?>/ad-admin/ad-admin-style/cdn/bootstrap/css/bootstrap-rtl.css"/>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
        <script type="text/javascript" src="<?php _e(SITE_URL) ?>/ad-admin/ad-admin-style/cdn/js/ajax.js"></script>
        <link rel="stylesheet" href="<?PHP _e(SITE_URL)?>/ad-admin/ad-admin-style/cdn/css/v3.css"/>
        <meta name="description" content="<?php _e($pDes)?>" />
        <meta name="keywords" content="<?php _e(implode(",",$pKey));?>" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css"/>
        <script type="text/javascript" src="<?PHP _e(SITE_URL)?>/ad-admin/ad-admin-style/cdn/js/tinymce/tinymce.min.js"></script>
        <script type="text/javascript">
        tinymce.init({
            selector: ".textEditor",
            language : 'ar',
            plugins: [
                "textcolor",
                "arphp",
                "advlist",
                "autolink",
                "lists",
                "visualblocks",
                "insertdatetime",
                "media",
                "table",
                "contextmenu",
                "link",
                "image",
                "charmap",
                "print",
                "preview",
                "anchor",
                "searchreplace",
                "code",
                "fullscreen",
                "paste",
            ],
        toolbar: "forecolor backcolor insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
         entity_encoding : "raw",
         directionality : 'rtl',
         width:"800px",
         height:"350px"
    });
        </script>
    </head>
    <body>
        <div class="warp">
            <div class="header">
                <div class="logo">
                    <a href="<?php _e(SITE_URL) ?>"><?php _e($siteName) ?></a>
                    <br/>
                    <br/>
                    <span><?php _e($siteDescrip) ?></span>
                </div>
            </div>