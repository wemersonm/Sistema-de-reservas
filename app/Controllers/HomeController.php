<?php

namespace app\Controllers;

use app\Core\Request;
use app\Core\TemplateView;
use app\Database\Connection;
use app\Database\Filters;
use app\Database\Models\Car;
use app\Support\Csfr;

class HomeController extends TemplateView
{
    public function index()
    {
       
        $conn = new Connection;
        $car = new Car;
        $filter = new Filters;

        $filter->limit(50);
        $car->setFilters($filter);
       
       // print_r($car->update('id',"5",['vni'=>"1GMDX03E8VD266902","carMake"=>"Pontiac","carModel"=>"Trans Sport","carModelYear"=>"1997"]));
       
        return $this->view('home',[],'CarReserveXpress');
    }
    
}
