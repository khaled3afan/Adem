<?php
/**
 * FORMS POST
*/

$settingsDB = new AD_Query();
$view = new AD_View(null,"ad-admin-style");

// Email



// Password



/**
 *  
 * START WORK!
 * @since 0.1
 */

if(isset($_REQUEST['update'])){switch ($_REQUEST['update']){
///// SITE INFO ///////////////////////////////////////////////////////////
    case "site-info" :
        if(isset($_POST['sName']) && !empty($_POST['sName'])){
            $upSiteName = clearPOST($_POST['sName']);
            $updateSiteName = $settingsDB->updateSetting("site_name",$upSiteName);
            if($upSiteName){
               echo 1;
            }else{
               echo "حصل خطأ ما ..";
            }
        }
        if(isset($_POST['sDescrip']) && !empty($_POST['sDescrip'])){
            $upSiteDescrip = clearPOST($_POST['sDescrip']); 
            $updateSiteDescrip = $settingsDB->updateSetting("site_descrip",$upSiteDescrip);
            if($updateSiteDescrip){
                echo 1;
            }else{
                echo "حصل خطأ ما ..";
            }
        }
    
        if(isset($_POST['sUrl']) && !empty($_POST['sUrl'])){
            $upSiteUrl = clearPOST($_POST['sUrl']);;
            $addHTTP = "http://".$upSiteUrl;
            $updateSiteUrl = $settingsDB->updateSetting("site_url",$addHTTP);
            if($updateSiteUrl){
                echo 1;
            }else{
                echo "حصل خطأ ما ..";
            }
        }
        die();
        break;
///// GOOGLE CODE ///////////////////////////////////////////////////////////
    case "google-code" :
        if(isset($_POST['googleCode']) & !empty($_POST['googleCode'])){
            $return = array();
            $googleCode = addslashes($_POST['googleCode']);
            $script = "<script "; 
            if(substr($googleCode,0,8) == $script){
                $updateCode = $settingsDB->updateSetting("google_code",$googleCode);
                    if(isset($updateCode)){
                        $return['status'] = 1;
                        $return['msg'] = "تم إضافة الكود بنجاح .";
                        echo json_encode($return);
                    }else{
                        $return['status'] = 0;
                        $return['msg'] = "حصل خطأ ما .. أعتذر :(";
                        echo json_encode($return);
                    }
            }else{
                $return['status'] = 0;
                $return['msg'] = "تأكد أنها الشفرة المعنية يا صديقي :(";
                echo json_encode($return);
            }
        }
        die();
        break;
///// EMAIL ///////////////////////////////////////////////////////////
    case "email":
        
        if(isset($_POST['email']) && !empty($_POST['email'])){
            $return = array();
            $email = clearPOST($_POST['email']);
            $cheackEmail = filter_var($email,FILTER_SANITIZE_EMAIL);
            if($cheackEmail){
                $updateEmail = $settingsDB->updateSetting("email",$email);
                if($updateEmail){
                    $return['status'] = 1;
                    $return['msg'] = "تم تحديث البريد الالكتروني بنجاح!";
                    echo json_encode($return);
                }else{
                    $return['status'] = 0;
                    $return['msg'] = "حصل خطأ ما .. أعتذر .. أنا خجولٌ منك يا سيدي :(";
                    echo json_encode($return);
                }
            }else{
                $return['status'] = -0;
                $return['msg'] = "تأكد من أن هذا بريد الكتروني .. آسف يا سيدي سأتعبك لكن من أجلك!";
                echo json_encode($return);
            }
        }
        die();
        break;
///// PASSWORD ///////////////////////////////////////////////////////////
    case "password":
        if(isset($_POST['newPass']) && !empty($_POST['newPass']) && isset($_POST['newPassR']) && !empty($_POST['newPassR'])){
            $return = array();
            $newPass = clearPOST($_POST['newPass']);
            $newPassR = clearPOST($_POST['newPassR']);
            if(is_admin() == TRUE){
                if($newPass == $newPassR){
                    $mdPass = md5(md5($newPass));
                    $updatePassword = $settingsDB->updateSetting("password",$mdPass);
                    if($updatePassword){
                        $return['status'] = 1;
                        $return['msg'] = "سيدي .. تم تغيير كلمة المرور بنجاح .. !";
                        echo json_encode($return);
                    }else{
                        $return['status'] = 0;
                        $return['msg'] = "سيدي .. أنا خجولٌ منك! .. حصل خطأ ما :(";
                        echo json_encode($return);
                    }
                }else{
                    $return['status'] = 0;
                    $return['msg'] = "كلمتا المرور لم تتطابقا ، أعد الكرّة لو سمحت .";
                    echo json_encode($return);
                }
            }else{
                $return['status'] = 0;
                $return['msg'] = "لا تمتلك الصلاحيات اللازمة لذلك .";
                echo json_encode($return);
            }
        }
        die();
}
}
/* VEIWS */
$view->view("vSettings",array(
    "title" => "الإعدادات",
    "Des"=>"",
    "key"=>array()
));