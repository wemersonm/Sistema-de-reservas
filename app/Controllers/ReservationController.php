<?php

namespace app\Controllers;

use app\Core\Request;
use app\Core\TemplateView;
use app\Database\Filters;
use app\Database\Models\ModelGeneric;

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

        $this->view('reservations', $data, 'Minhas reservas');
    }

  
    public function webhook()
    {
        /* $path = '../testeWebhook.txt';
        $content = Request::all();

        file_put_contents($path,$content); */

        
    }
}
