<?php

namespace app\Controllers;

use app\Support\Payment;
use app\Database\Filters;
use app\Core\TemplateView;
use app\Database\Models\ModelGeneric;
use app\Support\ReservationSupport;

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
        $filters->orderBy('created_at', 'DESC');
        $reservations->setFilters($filters);
        $reservations->setFields('reserved_cars.*, ' . FIELDS);
        $reservations->multipleJoin('cars', 'cars.idCar', '=', 'reserved_cars.idCar');
        $reservations = joinsCar($reservations);

        $data['reservationsCar'] = $reservations->dumpJoin() ?? [];

        if (count($data['reservationsCar']) > 0) {
            $now = time();
            foreach ($data['reservationsCar'] as $key => $infoCar) {
                if ($infoCar['paymentStatus'] == null) {
                    $fullDate = $infoCar['pickupDate'] . ' ' . $infoCar['pickupHour'];
                    if ($now < strtotime($fullDate)) {
                        $payment = new Payment();
                        $dataPayment = $payment->findPreference($infoCar['idPreference']);
                        $data['reservationsCar'][$key]['sandbox'] = $dataPayment->init_point;
                        $data['reservationsCar'][$key]['canCancell'] = true;
                    } else {
                        $data['reservationsCar'][$key]['paymentStatus'] = 'cancelled';
                    }
                } elseif ($infoCar['paymentStatus'] != 'cancelled') {
                    $fullDate = $infoCar['pickupDate'] . ' ' . $infoCar['pickupHour'];
                    if ($now < strtotime($fullDate)) {
                        $data['reservationsCar'][$key]['canCancell'] = true;
                    }
                }
            }
        }

        $this->view('reservations', $data, 'Minhas reservas');
    }

    public function cancel(mixed $idReserve)
    {
        $idReserve = $idReserve[0];

        if (!is_numeric($idReserve)) {
            return redirect($_SESSION[REDIRECT_BACK]['previus']);
            die;
        }

        ReservationSupport::cancelReserve($idReserve);
    }
}
