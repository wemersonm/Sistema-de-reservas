<?php

namespace app\Controllers;

use app\Core\TemplateView;

class NotFoundController extends TemplateView
{
    public function index(){
        $this->view('404',[],'Pagina nãoo encontrada');
    }
}