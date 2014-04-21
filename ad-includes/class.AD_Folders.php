<?php

/**
 * Description of class
 *
 * @author Fares AlBelady
 */
class AD_Folders {
    
    /**
     * @access public
     * @var type boolen
     */
    public $showError = TRUE;
    
    /**
     * @access protected
     * @param type $eMsg
     */
    protected function Error($eMsg){
        echo '<!DOCTYPE html>
            <html>
            <head>
                <title>خطأ</title>
                <meta charset="UTF-8">
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <meta name="viewport" content="width=device-width">
            </head>
            <body dir="rtl">
            <h1 style="color:red">حصل خطأ!</h1>
            ';
        if($this->showError == TRUE){
            echo '<h3>نص الخطأ :</h3>
            <p>'.$eMsg.'</p>
            </body>
            </html>';
        }elseif($this->showError == FALSE){
            echo '
            </body>
            </html>';
        }else{
            die();
        }
            
    }
    
    /**
     * 
     * @param type $dir
     * @return False if no dirs in Folder , return Array if folder have dirs
     * @access public
     * @since v0.2
     * @version 1.1
     */
    public function getDirs($dir){
        $realpath = realpath($dir);
        if(is_dir($realpath)){
            $DIRs = scandir($dir);
            $bad = array('','.','..');
            $a =  array_diff($DIRs, $bad);
            foreach($a as $item){
                if(is_dir($dir.'/'.$item)){
                    $d[] = $item;
                }
            }
            if(isset($d) && $d != ""){
                return $d;
            }else{
                return FALSE;
            }
        }else{
            $this->Error("تعذر وجود هذا المجلد : $dir");
        }
    }
    /**
     * 
     * @param type $dir
     * @return False if no files in Folder , return Array if folder have files
     * @access public
     * @since v0.2
     * @version 1.1
     */
    public function getFiles($dir){
        $realpath = realpath($dir);
        if(is_dir($realpath)){
            $DIRs = scandir($dir);
            $bad = array('','.','..');
            $a =  array_diff($DIRs, $bad);
            foreach($a as $item){
                if(is_file($dir.'/'.$item)){
                    $d[] = $item;
                }
            }
            if(isset($d)){
                return $d;
            }else{
                return FALSE;
            }
        }else{
            $this->Error("تعذر وجود هذا المجلد : $dir");
        }
    }
}