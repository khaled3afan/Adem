<?php

/**
 * @package Adem
 * @version 0.1
 * @since 0.2
 * @author Fares AlBelady
 */
class AD_AutoLoader {
    
    protected $path;


    public function __construct($pathOfFolder) {
        $this->path = realpath($pathOfFolder).DIRECTORY_SEPARATOR;
        
        $this->setGetClasses();
    }
    
    protected function setGetClasses(){
        spl_autoload_register(function($file){
        require $this->path."class.".$file.".php";
    });
    }
}