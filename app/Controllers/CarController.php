<?php

namespace app\Controllers;

use app\Core\TemplateView;
use app\Database\Filters;
use app\Database\Models\Car;
use app\Database\Models\ModelGeneric;


class CarController  extends TemplateView
{
    public function __construct()
    {
        if(isset($_SESSION[DATA_RESERVE])){
            unset($_SESSION[DATA_RESERVE]);
        }
    }
    public function show()
    {

        $car = new Car;
        $carManufaturer = new ModelGeneric('car_manufaturer');
        $typeCar = new ModelGeneric('type_cars');
        $carTransmission = new ModelGeneric('car_transmission');
        $carFuel = new ModelGeneric('car_fuel');

        $car->setFields(FIELDS);
        $car = joinsCar($car);
        $data['cars'] = $car->dumpJoin();
        $data['carManufaturer'] = $carManufaturer->fetchAll();
        $data['typeCar'] = $typeCar->fetchAll();
        $data['carTransmission'] = $carTransmission->fetchAll();
        $data['carFuel'] = $carFuel->fetchAll();


        return TemplateView::view('showCars', $data, 'Lista de carros');
    }
    public function details($slug)
    {
        $slug = $slug[0];
        if (!isSlug($slug)) {
            return redirect("/error");
        }
        $slug = strip_tags($slug);
        $car = new ModelGeneric("cars");
        $filters = new Filters;

        $filters->where('cars.slugCar', '=', $slug);
        $car->setFilters($filters);
        $car->setFields(FIELDS);
        $car = joinsCar($car);
        $data = $car->dumpJoin();
    
        $_SESSION[DATA_RESERVE][DATA_CAR] = $data[0];

       
        return TemplateView::view('detailsOrder', $data[0], 'Detalhes da reserva');
    }
}
