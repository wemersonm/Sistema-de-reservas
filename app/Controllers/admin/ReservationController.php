<?php

namespace app\Controllers\admin;

use app\Core\Request;
use app\Core\TemplateView;
use app\Database\Filters;
use app\Database\Models\ModelGeneric;
use app\Support\AccessLevel;
use app\Support\FlashMessages;
use app\Support\ReservationSupport;

class ReservationController extends TemplateView
{
    public function __construct()
    {
        $access = AccessLevel::getAccessLevel();
        if (!($access === 'manager' || $access === '*' || $access === 'empolyee') ) {
            return redirect("/admin");
            die;
        }
    }
    public function index()
    {
        // dd("Aqui");
        $filters = new Filters;

        if (!empty($_GET['dateReserve'])) {
            $datetime = strtotime($_GET['dateReserve']);
            if ($datetime != false) {
                $filters->where('reserved_cars.pickupDate', '>=', date("Y-m-d", $datetime));
            }
        }
        if (!empty($_GET['idReserve'])) {
            $idReserve = $_GET['idReserve'];
            if (is_numeric($idReserve) && (intval($idReserve) > 0)) {
                $filters->where('reserved_cars.idReserve', '=', $idReserve);
            }
        }
        
        $filters->dumpAnd($filters);

        $reserves = new ModelGeneric("reserved_cars");
        $reserves->setFilters($filters);
        $reserves->setFields(FIELDS_RESERVES);
        $reserves = joinsReserve($reserves);

        $data['cars_reserved'] = $reserves->dumpJoin();

        return $this->view('admin/homeReserves',  $data, 'Reservas');
    }
    public function show(mixed $idReserve)
    {
        $idReserve = $idReserve[0];

        $reserves = new ModelGeneric("reserved_cars");
        $filters = new Filters;
        $filters->where('idReserve', '=', $idReserve);
        $reserves->setFilters($filters);
        $reserves->setFields(FIELDS_RESERVES);
        $reserves = joinsReserve($reserves);

        $data['cars_reserved'] = $reserves->dumpJoin();

        return $this->view('admin/showReserve',  $data, 'Reservas');
    }

    public function confirmCollect(mixed $idReserve)
    {

        $idReserve = $idReserve[0];

        $reserves = new ModelGeneric("reserved_cars");

        if (!$reserves->update('idReserve', $idReserve, ['collected' => '1'])) {
            FlashMessages::setFlashMessage('errorUpdate', "Erro ao definir coleta do veiculo");
            return  redirect($_SESSION[REDIRECT_BACK]['previus']);
            die;
        }
        FlashMessages::setFlashMessage('successUpdate', "Carro definido como coletado");
        return  redirect($_SESSION[REDIRECT_BACK]['previus']);
        die;
    }
    public function confirmReturn(mixed $idReserve)
    {

        $idReserve = $idReserve[0];

        $reserves = new ModelGeneric("reserved_cars");

        if (!$reserves->update('idReserve', $idReserve, array('returned' => '1'))) {
            FlashMessages::setFlashMessage('errorUpdate', "Erro ao definir devolução do veiculo");
            return  redirect($_SESSION[REDIRECT_BACK]['previus']);
            die;
        }
        FlashMessages::setFlashMessage('successUpdate', "Carro definido como devolvido");
        return  redirect($_SESSION[REDIRECT_BACK]['previus']);
        die;
    }

    public function cancelReserve($idReserve)
    {

        $idReserve = $idReserve[0];

        if (!is_numeric($idReserve)) {
            return redirect($_SESSION[REDIRECT_BACK]['previus']);
            die;
        }

        ReservationSupport::cancelReserve($idReserve);
    }

    public function cancelCollect($idReserve)
    {
        $idReserve = $idReserve[0];

        $reserves = new ModelGeneric("reserved_cars");

        if (!$reserves->update('idReserve', $idReserve, ['collected' => '-1'])) {
            FlashMessages::setFlashMessage('errorUpdate', "Erro ao definir coleta do veiculo");
            return  redirect($_SESSION[REDIRECT_BACK]['previus']);
            die;
        }
        FlashMessages::setFlashMessage('successUpdate', "Carro definido como não coletado");
        return  redirect($_SESSION[REDIRECT_BACK]['previus']);
        die;
    }

    public function cancelReturn(mixed $idReserve)
    {

        $idReserve = $idReserve[0];

        $reserves = new ModelGeneric("reserved_cars");

        if (!$reserves->update('idReserve', $idReserve, array('returned' => '-1'))) {
            FlashMessages::setFlashMessage('errorUpdate', "Erro ao definir devolução do veiculo");
            return  redirect($_SESSION[REDIRECT_BACK]['previus']);
            die;
        }
        FlashMessages::setFlashMessage('successUpdate', "Carro definido como não devolvido");
        return  redirect($_SESSION[REDIRECT_BACK]['previus']);
        die;
    }
    public function searchReserve()
    {
        dd("Chegou");
    }
}
