<?php

namespace app\Support;

use app\Core\Request;
use Exception;

class Csfr
{
    
    public static function setCsfr(){
        if(isset($_SESSION["tokenCsfr"])){
            unset($_SESSION['tokenCsfr']); 
        }
        $token = md5(uniqid());
        $_SESSION['tokenCsfr'] = $token;

        return "<input type='hidden' name='tokenCsfr' value='{$token}'>";
    }
    public static function validateCsfr(){

        if(!isset($_SESSION['tokenCsfr'])){
            throw new Exception("1 Token invalido");
        }

        $token = Request::input('tokenCsfr');
        
        if($_SESSION['tokenCsfr'] != $token){
            throw new Exception("2 Token invalido");
        }
        unset($_SESSION['tokenCsfr']);
        return true;
    }

}