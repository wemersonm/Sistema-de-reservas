<?php

namespace app\Controllers\admin;

use app\Core\TemplateView;
use app\Database\Models\ModelGeneric;

class ReservationController extends TemplateView
{
    public function index(){

        $reserves = new ModelGeneric("reserved_cars");
        $reserves->setFields(FIELDS_RESERVES);
        $reserves = joinsReserve($reserves);
       
        $data['cars_reserved'] = $reserves->dumpJoin();
        
        return $this->view('admin/homeReserves',  $data, 'Reservas');

    }
}