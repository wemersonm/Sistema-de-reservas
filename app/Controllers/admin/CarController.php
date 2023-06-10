<?php

namespace app\Controllers\admin;

use app\Core\Request;
use app\Core\TemplateView;
use app\Database\Filters;
use app\Database\Models\ModelGeneric;
use app\Support\Csfr;
use app\Support\Validate;

class CarController extends TemplateView
{
    public function index()
    {
        $car = new ModelGeneric('cars');

        $car->setFields(FIELDS);
        $car = joinsCar($car);
        $data['cars'] = $car->dumpJoin();
        //dd( $data['cars']);
        return $this->view('admin/homeCars',  $data, 'Gestão de carros');
    }
    public function edit(mixed $param)
    {
        $idCar = $param[0];
        $car = new ModelGeneric("cars");
        $filters = new Filters;
        $carManufaturer = new ModelGeneric('car_manufaturer');
        $typeCar = new ModelGeneric('type_cars');
        $carTransmission = new ModelGeneric('car_transmission');
        $carFuel = new ModelGeneric('car_fuel');

        $filters->where('cars.idCar', '=', $idCar);
        $car->setFilters($filters);
        $car->setFields(FIELDS);
        $car = joinsCar($car);
        $data['car']  = $car->dumpJoin()[0];
        
        $data['carManufaturer'] = $carManufaturer->fetchAll();
        $data['typeCar'] = $typeCar->fetchAll();
        $data['carTransmission'] = $carTransmission->fetchAll();
        $data['carFuel'] = $carFuel->fetchAll();
        
        return $this->view('admin/editCar',  $data, 'Gestão de carros');
    }
    public function update(mixed $idCar)
    {   
        Csfr::validateCsfr();
        $idCar = $idCar[0];
        if(!is_numeric($idCar)){
            return redirect("/admin/error");
            die;
        }
        
        $data = Request::all();
        $file = Request::file('fileCar');
        
        $validate = new Validate;
        $validations = $validate->validations([
            'nviCar' => 'required',
            'licensePlateCar' => 'required|licensePlate',
            'modelCar' => 'required',
            'yearCar' => 'required|size:4',
            'descriptionCar' => 'required',
            'capacityCar' => 'required|size:1',
            'pricePerDayCar' => 'required',
            'idManufature' => 'required',
            'typeCar' => 'required',
            'transmissionCar' => 'required',
            'typeFuelCar' => 'required',
            'offer' => 'required',
        ]);











    }
    public function delete(mixed $param)
    {
        dd("deletando ...");
    }
}
