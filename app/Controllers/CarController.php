<?php

namespace app\Controllers;

use app\Core\TemplateView;
use app\Database\Filters;
use app\Database\Models\Car;
use app\Support\Validate;


class CarController  extends TemplateView
{

    public function create()
    {
        return TemplateView::view('addCar', [], 'Pagina dos carros');
    }
    public function insert()
    {

        $validate = new Validate;
        $validations = $validate->validations([
            'vni' => 'required',
            'carMake' => 'required',
            'carModel' => 'required',
            'carModelYear' => 'required|maxLen:4|minLen:4'
        ]);
        if (!$validations) {
            return redirect("/cars/create");
        }
        dd("Criou");
    }

    public function show()
    {

        $car = new Car;
        $filters = new Filters;
        $car->setFields("cars.idCar, cars.nviCar, cars.modelCar, cars.yearCar, cars.descriptionCar, cars.capacityCar, cars.pricePerDayCar,
                         cars.idManufature, car_manufaturer.nameManufature, car_manufaturer.imageManufature,
                         cars.typeCar, type_cars.nameTypeCar,
                         cars.transmissionCar, car_transmission.nameTransmissionCar,
                         cars.typeFuelCar, car_fuel.nameFuelCar");
        $car->multipleJoin('car_manufaturer', 'cars.idManufature', '=', 'car_manufaturer.idManufature', 'inner join');
        $car->multipleJoin('type_cars', 'cars.typeCar', '=', 'type_cars.idTypeCar', 'inner join');
        $car->multipleJoin('car_transmission', 'cars.transmissionCar', '=', 'car_transmission.idTransmissionCar', 'inner join');
        $car->multipleJoin('car_fuel', 'cars.typeFuelCar', '=', 'car_fuel.idFuelCar', 'inner join');
        dd($car->dumpJoin());
        return TemplateView::view('showCars', [], 'Lista de carros');
    }
}
