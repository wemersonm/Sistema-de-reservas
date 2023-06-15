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

                '/admin/car/create' => "admin\CarController@create",
                '/admin/car/manufaturer/create' => "admin\CarController@createManufaturer",

                '/admin/reserves' => 'admin\ReservationController@index',
                '/admin/reserve/[0-9]+' => 'admin\ReservationController@show',

                '/admin/reserve/confirmCollect/[0-9]+' => 'admin\ReservationController@confirmCollect',
                '/admin/reserve/confirmReturn/[0-9]+' => 'admin\ReservationController@confirmReturn',
                '/admin/reserve/cancelCollect/[0-9]+' => 'admin\ReservationController@cancelCollect',
                '/admin/reserve/cancelReturned/[0-9]+' => 'admin\ReservationController@cancelReturn',

                

                '/admin/reserve/cancelReserve/[0-9]+' => 'admin\ReservationController@cancelReserve',

                '/admin/reserve/searchReserve' => 'admin\ReservationController@searchReserve',
                '/admin/empolyees' =>  'admin\EmpolyeeController@index',
                '/admin/empolyee/edit/[0-9]+' => 'admin\EmpolyeeController@edit',
                '/admin/empolyee/delete/[0-9]+' => 'admin\EmpolyeeController@delete',
                '/admin/empolyee/create' => 'admin\EmpolyeeController@create',

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

               '/admin/car/create' => "admin\CarController@insert",

               '/admin/car/manufaturer/insert' => 'admin\CarController@insertManufaturer',

               '/admin/empolyee/edit/[0-9]+' => 'admin\EmpolyeeController@update',

               '/admin/empolyee/create' => 'admin\EmpolyeeController@insert',


              


            ]
        ];
    }
}
