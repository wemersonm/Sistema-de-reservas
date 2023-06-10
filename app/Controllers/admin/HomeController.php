<?php

namespace app\Controllers\admin;

use app\Core\TemplateView;

class HomeController extends TemplateView
{
    public function __construct()
    {
        return !isset($_SESSION[ADM_LOGGED]) || empty($_SESSION[ADM_LOGGED]) ?
            redirect('/admin/login') :
            "";
    }
    public function index()
    {
        
        return $this->view('admin/home', [], 'Painel Administrativo');
        
    }
}
