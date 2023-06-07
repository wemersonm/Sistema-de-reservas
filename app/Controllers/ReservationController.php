<?php

namespace app\Controllers;

use app\Core\Request;
use app\Core\TemplateView;
use app\Database\Filters;
use app\Database\Models\ModelGeneric;
use app\Support\Payment;

class ReservationController extends TemplateView
{
    public function __construct()
    {
        return !isLogged() ? redirect("/login") : '';
    }
    public function index()
    {
        $car = new ModelGeneric('cars');
        $reservations = new ModelGeneric('reserved_cars');
        $filters = new Filters;
        $dataUser = $_SESSION[LOGGED];
        $filters->where('reserved_cars.idUser', '=', $dataUser['idUser']);
        $reservations->setFilters($filters);
        $reservations->setFields('reserved_cars.*, ' . FIELDS);

        $reservations->multipleJoin('cars', 'cars.idCar', '=', 'reserved_cars.idCar');
        $reservations = joinsCar($reservations);

        $data['reservationsCar'] = $reservations->dumpJoin();
        foreach($data['reservationsCar'] as $key => $infoCar){
            if($infoCar['paymentStatus'] == null){
                $now = time();
                $fullDate = $infoCar['pickupDate']. ' '. $infoCar['pickupHour'];
                if($now < strtotime($fullDate)){
                    $payment = new Payment();
                    $dataPayment = $payment->findPreference($infoCar['idPreference']);
                    $data['reservationsCar'][$key]['sandbox'] = $dataPayment->init_point;
                }
                else{
                    $data['reservationsCar'][$key]['paymentStatus'] = 'cancelled';
                }
            }
        }
       
        $this->view('reservations', $data, 'Minhas reservas');
    }

  
   
}
