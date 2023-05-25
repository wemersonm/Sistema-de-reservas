<?php

namespace app\Controllers;

use app\Core\TemplateView;

class HomeController extends TemplateView
{
    public function index()
    {
        return $this->view("home",[],'Titulo merda');
    }
    public function teste($params)
    {
        echo "Estou no teste";
    }
}
