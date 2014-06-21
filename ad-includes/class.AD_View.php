<?php

/**
 * 
 * @author Fares AlBelady
 * @since 0.2
 * @version 1
 * 
 */


class AD_View {
    
    protected $dir;
    protected $ex;
    public $showError = TRUE;
    protected $vars;
    protected $theme_path;

    /**
     * 
     * @param type $dir Dir name
     * @param type $ex File exe
     * @see setTheme()
     * @see getFunctions()
     * @return void
     */

    public function __construct($theme_name = null,$dir=null,$ex = null){
        if($dir == null){
            $dir = "ad-content".DIRECTORY_SEPARATOR."ad-themes";
        }
        if($ex == null){
            $ex = ".php";
        }
        $this->dir = realpath($dir) . DIRECTORY_SEPARATOR;
        $this->ex = $ex;
        $this->setTheme($theme_name);
    }
    /**
     * 
     * @param type $them_name = The name of folder has a them files 
     */
    protected function setTheme($them_name){
        $them_path = $this->dir.$them_name;
        $this->theme_path = $them_path;
    }
    
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
     * @param type $File_Name string , View Files
     * @param type $vars array , pass some important vars to View File
     */
    protected function load($File_Name,$vars = array()){
        
        $file = $this->theme_path.DIRECTORY_SEPARATOR.$File_Name.$this->ex;

        if(is_file($file) && file_exists($file)){

            if(!empty($this->vars)){
                $add = array_merge($this->vars,$vars);
                extract($add);
            }else{
                extract($vars);
            }
            
            // PAGE important INFO
            $pTitle = isset($title) ? $title : null;
            $pDes = isset($Des) ? $Des : null;
            $pKey = isset($key) ? $key : null;
            
            // SET AS Globals FOR TEMPLATE Functions!
            $GLOBALS['pTitle'] = $pTitle;
            $GLOBALS['pDes']= $pDes;
            $GLOBALS['pKey'] = $pKey;
            
           
            
            // include Template Functions!
            //if($this->dir != ASB_PATH.DIRECTORY_SEPARATOR."ad-admin".DIRECTORY_SEPARATOR."ad-admin-style".DIRECTORY_SEPARATOR){
                
            if(strpos($this->dir,"ad-themes")){
                include ASB_PATH.DIRECTORY_SEPARATOR."ad-includes".DIRECTORY_SEPARATOR."template-functions.php";
                 // SOME Classes NEEDED!
                $AD_Query = new AD_Query;
            
                // SET Classes AS Globals FOR TEMPLATE Functions!
                $GLOBALS['AD_Query'] = $AD_Query;
            }elseif(strpos($this->dir,"ad-admin-style")){
                //include ASB_PATH.DIRECTORY_SEPARATOR."ad-admin".DIRECTORY_SEPARATOR."admin-inculdes".DIRECTORY_SEPARATOR."tmpl-admin-function.php";
            }
            // START RENDER!
            ob_start();
            // File Render!
            require $file;
            // Rendered! , Return values!!
            return ob_get_clean();
        }else{
            $this->Error("لم يتم العثور على ملف العرض ."."<br/>"."مسار الملف المفترض عرضه : ".$file);
        }
    }
    
   /**
    * 
    * @param type $var
    * @param type $value
    */ 
    public function set($var, $value = null){
        $var = is_array($var) ? $var : array($var => $value);
        $this->vars = array_merge((array) $this->vars, $var);
    }
    
    /**
     * 
     * @param type $varH
     * @return type Bool
     */
    public function has($var){
        return isset($this->vars[$var]);
    }
    
    /**
     * 
     * @param type $vars array or string
     */
    public function remove($vars){
        foreach ($a as $vars){
            unset($this->vars[$vars]);
        }
    }
    
    public function view($viewer,$vars = null){
        echo $this->load($viewer,(array)$vars);
    }
}