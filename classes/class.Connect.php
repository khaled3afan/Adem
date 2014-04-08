<?php
/*
 * 
 * Class Connect DB ;
 * 
 */

class FrConnect{
    
    private $DB_HOST;
    private $DB_USER;
    private $DB_PASS;
    private $DB_NAME;
    private $connect;
    private $select;
    private $close;
    private $charset;


    public function __construct($Host,$User,$Pass,$DBName) {
        $this->DB_HOST = $Host;
        $this->DB_USER = $User;
        $this->DB_PASS = $Pass;
        $this->DB_NAME = $DBName;
    }
    
    public function connectDB(){
        $this->connect = mysql_connect($this->DB_HOST,$this->DB_USER,$this->DB_PASS);
        if(!$this->connect){
            die(mysql_error());
        }
    }
    
    public function selectDB(){
        $this->select = mysql_select_db($this->DB_NAME);
        if($this->select){
            return $this->select;
        }else{
            die(mysql_error());
        }
    }
    
    public function setCharset(){
        $char = $this->charset = mysql_set_charset("UTF8");
        return $char;
    }

    public function __destruct() {
        $close = mysql_close($this->connect);
		return $close;
    }
}