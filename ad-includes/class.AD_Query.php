<?php

class AD_Query {
    
    private $queryVar;
    private $rowVar;
    private $numVar;
    private $freeVar;
    private $select;
    private $multySettings;
    private $updateSettings;
    private $val;
    private $update_social;
    private $social_val;

    public function DB_Query($qCode){
        $this->queryVar = mysql_query($qCode);
        if($this->queryVar){
            return $this->queryVar;
        }else{
            mysql_error();
            return FALSE;
        }
    }
    
    public function DB_FetAs($qCode){
        $this->rowVar = mysql_fetch_assoc($qCode);
        return $this->rowVar;
    }
    
    public function DB_Num($qCode){
        $this->numVar = mysql_num_rows($qCode);
        return $this->numVar;
    }
    
    public function DB_Free($qCode){
        $this->free = mysql_free_result($qCode);
        return $this->freeVar;
    }
    
    public function getSetting($setName){
        $this->select = $this->DB_Query("SELECT sett_value FROM settings WHERE sett_name='$setName'");
        if($this->select){
            return $this->select;
        }else{
            mysql_error();
            return FALSE;
        }
    }
    public function getMSettingsByIDs($setIDs){
        $this->multySettings = $this->DB_Query("SELECT sett_value FROM settings WHERE sid IN ($setIDs)");
        if($this->multySettings){
            return $this->multySettings;
        }else{
            mysql_error();
            return FALSE;
        }
    }
    
    public function updateSetting($settName,$NewValue){
        $this->updateSettings = $this->DB_Query("UPDATE settings SET sett_value='$NewValue' WHERE sett_name='$settName'");
        if($this->updateSettings){
            return $this->updateSettings;
        }else{
            mysql_error();
            return false;
        }
    }
    
    public function getSettingVal($setName){
        $query = $this->DB_Query("SELECT sett_value FROM settings WHERE sett_name='$setName'");
        if($query){
            while($value = $this->DB_FetAs($query)){
                $this->val = $value['sett_value'];
            }
            return $this->val;
        }else{
            mysql_error();
            return FALSE;
        }
    }
    
    public function updateSocial($s_name,$s_link){
        $q = $this->DB_Query("UPDATE social SET sc_link='$s_link' WHERE sc_name='$s_name'");
        if($q){
            $this->update_social = $q;
            return $this->update_social;
        }else{
            mysql_error();
            return FALSE;
        }
    }
    
    public function getSocial($s_name){
        $q = $this->DB_Query("SELECT sc_link FROM social WHERE sc_name='$s_name'");
        if($q){
            while ($val = $this->DB_FetAs($q)){
                $this->social_val = $val['sc_link'];
            }
            echo $this->social_val;
        }else{
            mysql_error();
            return FALSE;
        }
    }
}