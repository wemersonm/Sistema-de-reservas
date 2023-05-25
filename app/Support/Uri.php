<?php

namespace app\Support;

class Uri
{
    public static function getUri(){
        return parse_url($_SERVER['REQUEST_URI'])['path'];
    }
}