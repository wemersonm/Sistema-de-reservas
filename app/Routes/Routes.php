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
 

                // admin routes
                '/admin/login' => "admin\LoginController@index",
                '/admin/logout' => "admin\LoginController@logout",

                '/admin' => "admin\HomeController@index",

                '/admin/cars' => "admin\CarController@index",

                '/admin/car/edit/[0-9]+' => "admin\CarController@edit",
                '/admin/car/delete/[0-9]+' => "admin\CarController@delete",



                '/admin/error' => 'admin\NotFoundController@index',




            ],
            'POST' => [
                '/login' => "LoginController@enter",
                '/userRegister' => "RegistrationController@create",
                '/car/reserve' => "CheckoutController@insertDetails",
                '/webhook' => "CheckoutController@webhook",

                // admin routes
                '/admin/login' => "admin\LoginController@enter",

               '/admin/car/edit/[0-9]+' => "admin\CarController@update",

            ]
        ];
    }
}
