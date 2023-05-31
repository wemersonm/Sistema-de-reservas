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

                
                '/checkout/pay' => 'CheckoutController@pay',
                
                '/success' => "PaymentStatusController@success",
                '/failure' => "PaymentStatusController@failure",
                '/pending' => "PaymentStatusController@pending",

                '/webhook' => "ReservationController@webhook",

                '/error' => 'NotFoundController@index',

            ],
            'POST' => [
                '/login' => "LoginController@enter",
                '/car/reserve' => "CheckoutController@insertDetails",
               

            ]
        ];
    }
}
