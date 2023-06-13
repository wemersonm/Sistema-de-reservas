<?php

namespace app\Controllers\admin;

use app\Core\TemplateView;
use app\Database\Models\ModelGeneric;
use app\Support\AccessLevel;

class EmpolyeeController extends TemplateView
{
    public function __construct()
    {
        $access = AccessLevel::getAccessLevel();
        if (!($access === "*")) {
            return redirect("/admin");
            die;
        }
    }
    public function index()
    {

        $admins = new ModelGeneric("users_admin");

        $data['empolyees'] = $admins->fetchAll();
        return $this->view('admin/homeEmpolyee',  $data, 'Reservas');
    }
}
