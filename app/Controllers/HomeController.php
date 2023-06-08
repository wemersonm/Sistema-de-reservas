<?php

namespace app\Controllers;

use app\Core\TemplateView;
use app\Database\Filters;
use app\Database\Models\ModelGeneric;

class HomeController extends TemplateView
{
    public function __construct()
    {
        if (isset($_SESSION[DATA_RESERVE])) {
            unset($_SESSION[DATA_RESERVE]);
        }
    }
    public function index()
    {

        $cars = new ModelGeneric('cars');
        $filters = new Filters;
        $filters->where('cars.offer', '=', '1');
        $cars->setFilters($filters);
        $cars->setFields(FIELDS);
        $cars = joinsCar($cars);
        $dataCars = $cars->dumpJoin();


        if (isset($_SESSION[DATA_RESERVE])) {
            unset($_SESSION[DATA_RESERVE]);
        }
        return $this->view('home', $dataCars, 'CarReserveXpress');
    }
}
