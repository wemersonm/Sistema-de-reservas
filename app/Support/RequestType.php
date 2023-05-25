<?php

namespace app\Support;

class RequestType
{
    public static function getRequestType(){
        return $_SERVER['REQUEST_METHOD'];
    }
}