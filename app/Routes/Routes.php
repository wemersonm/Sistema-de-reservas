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
              

                '/cars' => "CarController@show",
                '/cars/[a-zA-Z0-9\-]+' => 'CarController@details',

                '/reservations' => 'ReservationController@index',
                '/checkout/details' => "CheckoutController@details",

                '/error' => 'NotFoundController@index',
                '/checkout/pay' => 'CheckoutController@pay'
                

            ],
            'POST' => [
                '/login' => "LoginController@enter",
                '/car/reserve' => "CheckoutController@insertDetails",
               

            ]
        ];
    }
}
