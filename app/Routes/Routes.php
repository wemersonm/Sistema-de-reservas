<?php

namespace app\Routes;

class Routes
{
    public static function get()
    {
        return [
            'GET' => [
                '/' => 'HomeController@index',
                '/login' => "LoginController@index",
                '/register' => "Registration@index",
                '/logout' => "LoginController@logout",
                '/cars/create' => "CarController@create",

                '/cars' => "CarController@show",

            ],
            'POST' => [
                '/login' => "LoginController@enter",

                '/cars/insert' => "Car@insert",

            ]
        ];
    }
}
