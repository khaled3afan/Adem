<?php

class AD_Query {
    public $showError = true;
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
    
    
    protected function Error($eMsg){
        echo '<!DOCTYPE html>
            <html>
            <head>
                <title>خطأ</title>
                <meta charset="UTF-8">
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <meta name="viewport" content="width=device-width">
                <style>
                    body {
                         direction:rtl;
                    }
                    code {
                        background : #E9E9E9;
                        padding:5px;
                        margin:5px;
                        color: green;
                        border-radius: 5px;
                    }
                </style>
            </head>
            <body>
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
    
    public function DB_Query($qCode){
        $this->queryVar = mysql_query($qCode);
        if($this->queryVar){
            return $this->queryVar;
        }else{
            $this->Error(mysql_error());
        }
    }
    
    public function DB_Select($table,$options = null){
        if(isset($options)){
            if(is_array($options)){
                
                if(isset($options['fields'])){
                    $f= $options['fields'];
                    if(!empty($f)){
                        $fields = $f;
                    }else{
                        $this->Error("الخيار <code dir='ltr'>fields</code> في الدالة <code dir='ltr'>DB_Select()</code> فارغ .");
                        die;
                    }
                }else{
                    $fields = "*";
                }
                
                $query = "SELECT $fields FROM $table ";
                if(isset($options['where'])){
                    $where = $options['where'];
                    if(!empty($where)){
                        if(is_array($where)){
                            $key = $where[0];
                            $realship = $where[1];
                            $value = $where[2];
                            $query .= "WHERE $key $realship '".mysql_real_escape_string($value)."'";
                        }else{
                            $query .="WHERE $where";
                        }
                    }else{
                        $this->Error("الخيار <code dir='ltr'>where</code> في الدالة <code dir='ltr'>DB_Select()</code> فارغ .");
                        die;
                    }
                }
                if(isset($options['order'])){
                    $order = $options['order'];
                    if(!empty($order)){
                        if(is_array($order)){
                            if(count($order) == 1 || count($order) == 2){
                                $by = $order[0];
                                if(count($order) == 2){
                                    $how = $order[1];
                                    $query .="ORDER BY $by $how ";
                                }elseif(count($order) == 1){
                                    $query .="ORDER BY $by ";
                                }
                            }else{
                                $this->Error("عدد عناصر المصفوفة الخاصة بالخيار <code dir='ltr'>order</code> يجب أن تكون 2 أو 1 فقط .");
                                die;
                            }
                        }else{
                            $query .= "ORDER $order ";
                        }
                    }else{
                        $this->Error("الخيار <code dir='ltr'>Order</code> في الدالة <code dir='ltr'>DB_Select()</code> فارغ .");
                        die;
                    }
                }
                if(isset($options['limit'])){
                    $limit = $options['limit'];
                    if(!empty($limit)){
                        if(is_array($limit)){
                            if(count($limit) == 2){
                                $from = $limit[0];
                                $to = $limit[1];
                                $query .= "LIMIT $from,$to ";
                            }else{
                                $this->Error($eMsg);
                            }
                        }else{
                            $query .= " LIMIT $limit ";
                        }
                    }else{
                        $this->Error("الخيار <code dir='ltr'>limit</code> في الدالة <code dir='ltr'>DB_Select()</code> فارغ .");
                        die;
                    }
                }
                $q = $this->DB_Query($query);
                return $q;
            }else{
                $this->Error("الدالة <code dir='ltr'>DB_Select()</code> البارامتر الثاني لها لابد أن يكون مصفوفة .");
            }
        }else{
            $query = $this->DB_Query("SELECT * FROM $table");
            return $query;
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
            $this->Error(mysql_error());
        }
    }
    public function getMSettingsByIDs($setIDs){
        $this->multySettings = $this->DB_Query("SELECT sett_value FROM settings WHERE sid IN ($setIDs)");
        if($this->multySettings){
            return $this->multySettings;
        }else{
            $this->Error(mysql_error());
        }
    }
    
    public function updateSetting($settName,$NewValue){
        $this->updateSettings = $this->DB_Query("UPDATE settings SET sett_value='$NewValue' WHERE sett_name='$settName'");
        if($this->updateSettings){
            return $this->updateSettings;
        }else{
            $this->Error(mysql_error());
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
            $this->Error(mysql_error());
        }
    }
    
    public function updateSocial($s_name,$s_link){
        $q = $this->DB_Query("UPDATE social SET sc_link='$s_link' WHERE sc_name='$s_name'");
        if($q){
            $this->update_social = $q;
            return $this->update_social;
        }else{
            $this->Error(mysql_error());
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
            $this->Error(mysql_error());
        }
    }
}