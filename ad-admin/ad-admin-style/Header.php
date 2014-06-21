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
        <link rel="stylesheet" href="<?PHP _e(SITE_URL)?>/ad-admin/cdn/bootstrap/css/bootstrap-rtl.css"/>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
        <script type="text/javascript" src="<?php _e(SITE_URL) ?>/ad-admin/cdn/js/ajax.js"></script>
        <link rel="stylesheet" href="<?PHP _e(SITE_URL)?>/ad-admin/cdn/css/v3.css"/>
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css"/>
        <script type="text/javascript" src="<?PHP _e(SITE_URL)?>/ad-admin/cdn/js/tinymce/tinymce.min.js"></script>
        <script type="text/javascript">
        tinymce.init({
            selector: ".textEditor",
            language : 'ar',
            plugins: [
                "textcolor",
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
            theme_advanced_font_sizes: "10px,12px,13px,14px,16px,18px,20px",
            font_size_style_values: "12px,13px,14px,16px,18px,20px",
            toolbar: "forecolor backcolor insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | sizeselect | bold italic | fontselect |  fontsizeselect",
            entity_encoding : "raw",
            directionality : 'rtl',
            width:"800px",
            height:"350px",
            content_css : "<?php echo SITE_URL ?>/ad-admin/cdn/js/tinymce/tiny-box-style.css"
    });
        </script>
    </head>
    <body>
        <div class="warp">
            <div class="header">
                <div class="logo">
                    <a href="<?php echo SITE_URL ?>"><?php echo $siteName ?></a>
                    <br/>
                    <br/>
                    <span><?php echo $siteDescrip ?></span>
                </div>
            </div>