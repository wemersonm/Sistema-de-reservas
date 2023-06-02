<?php

namespace app\Support;

class ValidationsDataSessions
{
    public static function issetDataCarInSession()
    {
        return (!isset($_SESSION[DATA_RESERVE][DATA_CAR]) ||  empty($_SESSION[DATA_RESERVE][DATA_CAR])) ?
        false :
        true;  
           
    }
    public static function issetDataCarAndOrderInSession()
    {
        return (!isset($_SESSION[DATA_RESERVE][DATA_CAR]) ||  empty($_SESSION[DATA_RESERVE][DATA_CAR])) || 
        (!isset($_SESSION[DATA_RESERVE][DATA_ORDER]) ||  empty($_SESSION[DATA_RESERVE][DATA_ORDER])) ?
        false :
        true;
    }
}
