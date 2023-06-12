<?php

namespace app\Controllers\admin;

use app\Core\Request;
use app\Core\TemplateView;
use app\Database\Filters;
use app\Database\Models\ModelGeneric;
use app\Support\Csfr;
use app\Support\FileValidate;
use app\Support\FlashMessages;
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
        if (!is_numeric($idCar)) {
            return redirect("/admin/error");
            die;
        }

        $validate = new Validate;
        $validations = $validate->validations([
            'nviCar' => 'required',
            'licensePlateCar' => 'required|licensePlate',
            'modelCar' => 'required',
            'yearCar' => 'required|size:4|number',
            'descriptionCar' => 'required',
            'capacityCar' => 'required|size:1',
            'pricePerDayCar' => 'required',
            'idManufature' => 'required',
            'typeCar' => 'required',
            'transmissionCar' => 'required',
            'typeFuelCar' => 'required',
            'offer' => 'required',
            'fileCar' => 'fileImg'
        ]);


        if (!$validations) {
            return redirect($_SESSION[REDIRECT_BACK]['previus']);
            die;
        }
        if ($validations['fileCar'] !== true) {

            $fileName = $validations['modelCar'] . uniqid() . '.jpg';
            $moved = FileValidate::moveFile($validations['fileCar'], $fileName);
            if (!$moved) {
                FlashMessages::setFlashMessage('fileCar', "Erro ao salvar a imagem");
                return  redirect($_SESSION[REDIRECT_BACK]['previus']);
                die;
            }
            $validations['imageCar'] = $fileName;
        }
        unset($validations['fileCar']);
        $cars = new ModelGeneric('cars');
        if ($cars->update('idCar', $idCar, $validations)) {
            FlashMessages::setFlashMessage('successUpdate', "Carro editado com sucesso");
            return  redirect($_SESSION[REDIRECT_BACK]['previus']);
            die;
        }
    }
    public function delete(mixed $idCar)
    {
        $idCar = $idCar[0];
        if (!is_numeric($idCar)) {
            return redirect("/admin/cars");
            die;
        }

        $cars = new ModelGeneric("cars");
        $filters = new Filters;
        $filters->where('idCar', '=', $idCar);
        $cars->setFilters($filters);
        if ($cars->delete('idCar', $idCar)) {
            FlashMessages::setFlashMessage('successDelete', "Carro deletado com sucesso");
            return  redirect('/admin/cars');
            die;
        }
        FlashMessages::setFlashMessage('errorDelete', "Erro ao deletar carro");
        return  redirect('/admin/cars');
        die;
    }

    public function create()
    {
        $carManufaturer = new ModelGeneric('car_manufaturer');
        $typeCar = new ModelGeneric('type_cars');
        $carTransmission = new ModelGeneric('car_transmission');
        $carFuel = new ModelGeneric('car_fuel');
        $data['carManufaturer'] = $carManufaturer->fetchAll();
        $data['typeCar'] = $typeCar->fetchAll();
        $data['carTransmission'] = $carTransmission->fetchAll();
        $data['carFuel'] = $carFuel->fetchAll();

        return $this->view('admin/createCar',  $data, 'Adicionar veiculo');
    }
    public function insert()
    {
        Csfr::validateCsfr();
        $validate = new Validate;
        $validations = $validate->validations([
            'nviCar' => 'required',
            'licensePlateCar' => 'required|licensePlate',
            'modelCar' => 'required',
            'yearCar' => 'required|size:4|number',
            'descriptionCar' => 'required',
            'capacityCar' => 'required|size:1',
            'pricePerDayCar' => 'required',
            'idManufature' => 'required',
            'typeCar' => 'required',
            'transmissionCar' => 'required',
            'typeFuelCar' => 'required',
            'offer' => 'required',
            'fileCar' => 'fileRequired|fileImg'
        ]);
        if (!$validations) {
            return redirect($_SESSION[REDIRECT_BACK]['previus']);
            die;
        }


        $fileName = $validations['modelCar'] . uniqid() . '.jpg';
        $moved = FileValidate::moveFile($validations['fileCar'], $fileName);
        if (!$moved) {
            FlashMessages::setFlashMessage('fileCar', "Erro ao salvar a imagem");
            return  redirect($_SESSION[REDIRECT_BACK]['previus']);
            die;
        }
        $validations['imageCar'] = $fileName;
        unset($validations['fileCar']);

        $cars = new ModelGeneric('cars');
        if ($cars->create($validations)) {
            FlashMessages::setFlashMessage('successCreate', "Carro adicionado com sucesso");
            return  redirect("/admin/cars");
            die;
        }
    }

    public function createManufaturer()
    {
        return $this->view('admin/createManufaturer',  [], 'Adicionar marca');
    }
    public function insertManufaturer()
    {

        Csfr::validateCsfr();
        $validate = new Validate;
        $validations = $validate->validations([
            'nameManufature' => 'required',
            'descriptionManufature' => 'required',
            'fileCar' => 'fileRequired|fileImg'
        ]);

        if (!$validations) {
            return redirect($_SESSION[REDIRECT_BACK]['previus']);
            die;
        }

        $fileName = $validations['nameManufature'] . uniqid() . '.jpg';
        $moved = FileValidate::moveFile($validations['fileCar'], $fileName, 'carManufaturer');
        if (!$moved) {
            FlashMessages::setFlashMessage('fileCar', "Erro ao salvar a imagem");
            return  redirect($_SESSION[REDIRECT_BACK]['previus']);
            die;
        }
        $validations['imageManufature'] = $fileName;
        unset($validations['fileCar']);

        $carManufaturer = new ModelGeneric('car_manufaturer');
        if ($carManufaturer->create($validations)) {
            FlashMessages::setFlashMessage('successCreate', "Marca adicionado com sucesso");
            return  redirect("/admin/cars");
            die;
        }
    }
}
