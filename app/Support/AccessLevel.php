<?php

namespace app\Support;

class AccessLevel
{
    public static function getAccessLevel(){
        $dataUser = $_SESSION[ADM_LOGGED];
        if(!empty($dataUser['accessLevel'])){
            return $dataUser['accessLevel'];
        }
    }
}