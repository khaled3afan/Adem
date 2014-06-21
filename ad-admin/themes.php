<?php
session_start();

include '../ad-define.php';

if(is_admin()){
	$DB_THEMES = new AD_Query();

	$view = new AD_View(null,"ad-admin-style");

	$dirClass = new AD_Folders();

	$themesDir = ASB_PATH.DIRECTORY_SEPARATOR."ad-content".DIRECTORY_SEPARATOR."ad-themes";
	$themes = [];
	$themes['dirs'] = $dirClass->getDirs($themesDir);

	for ($i = 0; $i < count($themes['dirs']); $i++) {
		if(is_file($themesDir.DIRECTORY_SEPARATOR.$themes['dirs'][$i].DIRECTORY_SEPARATOR."photo.JPG")){
			$themes['img'][] = TRUE;
		}else{
			$themes['img'][] = FALSE;
		}
	}

	if(isset($_POST['theme_set']) && !empty($_POST['theme_set'])){
		$theme_set = clearPOST($_POST['theme_set']);
		for ($i = 0; $i < count($themes['dirs']); $i++) {
			if($theme_set == $themes['dirs'][$i]){
				if($theme_set == THEME_NAME){
					$return['success'] = 0;
					$return['msg'] = "هذا القالب مفعّل من قبل .";
					$view->set("return",$return);
					break;
				}else{
					$file = $dirClass->getFiles($themesDir.DIRECTORY_SEPARATOR.$theme_set);
					if(!empty($file)){
						$update = $DB_THEMES->updateSetting("theme_name",$theme_set);
						if(isset($update)){
							$return['success'] = 1;
							$view->set("return",$return);
							break;
						}else{
							$return['success'] = 0;
							$return['msg'] = "آسف حدث خطأ في اللحظات الأخيرة ، أرجو منك يا سيدي المحاولة في وقت لاحق .. يبدو أنني مرهق :(";
							$view->set("return",$return);
							break;
						}
					}else{
						$return['success'] = 0;
						$return['msg'] = "مجلد القالب خالٍ من الملفات المطلوبة ، الرجاء التحقق من وجود الملفات الضرورية.";
						$view->set("return",$return);
						break;
					}
				}
				$return['success'] = 1;
				$view->set("return",$return);
				break;
			}else{
				$return['success'] = 0;
				$return['msg'] = "مجلد هذا القالب غير موجود .";
				$view->set("return",$return);
			}
		}
	}

	$view->view("vThemes",array(
		"title"=>"القوالب",
		"Des"=>"",
		"key"=>array(),
		"themes"=>$themes
	));
}else{
    header("location: ".SITE_URL."/user/login");
}