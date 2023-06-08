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
                '/register' => "RegistrationController@index",
                '/logout' => "LoginController@logout",
              

                '/cars' => "CarController@show",
                '/cars/[a-zA-Z0-9\-]+' => 'CarController@details',

                '/reservations' => 'ReservationController@index',
                '/checkout/details' => "CheckoutController@details",

                '/reservation/cancel/[0-9]+' => "ReservationController@cancel",
                
                '/checkout/pay' => 'CheckoutController@pay',
                
                '/success' => "PaymentStatusController@success",
                '/failure' => "PaymentStatusController@failure",
                '/pending' => "PaymentStatusController@pending",

                

                '/error' => 'NotFoundController@index',

            ],
            'POST' => [
                '/login' => "LoginController@enter",
                '/userRegister' => "RegistrationController@create",
                '/car/reserve' => "CheckoutController@insertDetails",
                '/webhook' => "CheckoutController@webhook",

            ]
        ];
    }
}
