<?php

namespace app\Routes;

class Routes
{
    public static function get()
    {
        return [
            'GET' => [
                '/' => 'HomeController@index',
                '/car' => 'CarController@index',
                '/car/[0-9a-z]+' => "HomeController@teste"
            ],
            'POST' => [

            ]
        ];
    }
}
