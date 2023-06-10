<?php

namespace app\Controllers\admin;

use app\Core\TemplateView;

class NotFoundController extends TemplateView
{
    public function index(){
        $this->view('admin/404',[],'Pagina não encontrada');
    }
}