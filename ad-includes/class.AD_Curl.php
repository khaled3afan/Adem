<?php

/**
 * Curl Class
 * @since 0.5.2
 *
 * @author Fares AlBelady
 */
class AD_Curl {
    
    private $url;
    private $options;
    private $connect;
    public $result;


    public function __construct() {
        $this->connect = curl_init();
    }
    
    public function close(){
        $close = curl_close($this->connect);
        return $close;
    }

    

    public function send_post($url,$data = array(),$return = null){
        $return = is_null($return) ? true : $return;
        curl_setopt($this->connect,CURLOPT_URL,$url);
        curl_setopt($this->connect,CURLOPT_POST,1);
        curl_setopt($this->connect,CURLOPT_RETURNTRANSFER,$return);
        curl_setopt($this->connect,CURLOPT_POSTFIELDS, $data);
        
        $result = curl_exec($this->connect);
        $this->result = $result;
        return $this->array_result("json");
    }
    
    public function array_result($data_type){
        if(!empty($this->result)){
            switch ($data_type):
                case "json":
                   $json = json_decode($this->result,true);
                   return $json;
                    break;
            endswitch;
        }else{
            return false;
        }
    }
}