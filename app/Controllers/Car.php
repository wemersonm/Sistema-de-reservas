<?php

namespace app\Controllers;

use app\Core\TemplateView;
use app\Support\Validate;

class Car extends TemplateView
{

    public function create()
    {

        return TemplateView::view('cars', [], 'Pagina dos carros');
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
        if(!$validations){
            return redirect("/cars/create");
        }
        dd("Criou");
    }
}
