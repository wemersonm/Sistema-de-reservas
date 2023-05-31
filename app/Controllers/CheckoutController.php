<?php

namespace app\Controllers;


use app\Core\TemplateView;
use app\Database\Filters;
use app\Database\Models\ModelGeneric;
use app\Support\Csfr;
use app\Support\FlashMessages;
use app\Support\Validate;
use MercadoPago\Item;
use MercadoPago\Preference;
use MercadoPago\SDK;

class CheckoutController extends TemplateView
{
    public function __construct()
    {
        // return !isLogged() ? redirect("/login") : '';
    }
    public function insertDetails()
    {

        Csfr::validateCsfr();

        $validate = new Validate;
        $validations = $validate->validations([
            'pickupDate' => 'required|date',
            'pickupHour' => 'required|hour',
            'returnDate' => 'required|date',
            'returnHour' => 'required|hour',

        ]);

        if (!$validations) {
            return redirect($_SESSION['redirectBack']['previus']);
        }
        $fullDatePickup = ($validations['pickupDate'] . ' ' . $validations['pickupHour']);
        $fullDateReturn = ($validations['returnDate'] . ' ' . $validations['returnHour']);
        $fullDatePickupTime = strtotime($validations['pickupDate'] . ' ' . $validations['pickupHour']);
        $fullDateReturnTime = strtotime($validations['returnDate'] . ' ' . $validations['returnHour']);
        $now = time();
        $timeAdvance = strtotime('+1 hour', $now);

        if ($fullDatePickupTime < $timeAdvance) {
            FlashMessages::setFlashMessage('dateReserve', "A data de retirada deve ser 1 hora de antecedência !");
            return redirect(previusUrl());
        }
        if ($timeAdvance > $fullDateReturnTime || $fullDatePickupTime == $fullDateReturnTime) {
            FlashMessages::setFlashMessage('dateReserve', "A data de devolução deve nao pode ser antes ou igual da de coleta");
            return redirect(previusUrl());
        }

        unset($_SESSION[REDIRECT_BACK_LOGIN]);

        if (!isset($_SESSION[DATA_RESERVE][DATA_CAR]) ||  empty($_SESSION[DATA_RESERVE][DATA_CAR])) {
            return redirect("/");
        }

        $insertOrder = new ModelGeneric('details_order');
        $filters = new Filters;
        $dataUser = dataUserLogged();
        $dataCar = $_SESSION[DATA_RESERVE][DATA_CAR];
        $diff =  $fullDateReturnTime - $fullDatePickupTime;
        $days = floatval(floor($diff / (60 * 60 * 24)));
        $hours =  floatval(floor(($diff % (60 * 60 * 24)) / (60 * 60)));
        $minutes = floatval(floor(($diff % (60 * 60)) / 60));
        $pricePerDayCar = floatval($dataCar['pricePerDayCar']);

        $priceTotal = 0;
        if ($days >= 1) {
            $priceTotal += $days * $pricePerDayCar;
            $priceTotal += ($hours / 24.0) * $pricePerDayCar;
        } else {
            $priceTotal = $pricePerDayCar;
        }
        $priceTotal = number_format($priceTotal, 2, ",", ".");

        $dataOrder = [
            'idUser' => $dataUser['idUser'],
            'idCar' => $dataCar['idCar'],
            'pickupDate' => date("d/m/Y", strtotime($validations['pickupDate'])),
            'pickupHour' => $validations['pickupHour'],
            'returnDate' => date("d/m/Y", strtotime($validations['returnDate'])),
            'returnHour' => $validations['returnHour'],
            'priceOrder' => $priceTotal,
        ];

        $_SESSION[DATA_RESERVE][DATA_ORDER] = $dataOrder;


        return redirect('/checkout/details');
    }

    public function details()
    {

        if (
            (!isset($_SESSION[DATA_RESERVE][DATA_CAR]) ||  empty($_SESSION[DATA_RESERVE][DATA_CAR])) &&
            (!isset($_SESSION[DATA_RESERVE][DATA_ORDER]) ||  empty($_SESSION[DATA_RESERVE][DATA_ORDER]))
        ) {
            return redirect("/");
        }
        $data['dataCar'] = $_SESSION[DATA_RESERVE][DATA_CAR];
        $data['dataOrder'] = $_SESSION[DATA_RESERVE][DATA_ORDER];

        $this->view('checkout',  $data, 'Finalizar reserva');
    }

    public function pay()
    {

        $dataCar = $_SESSION[DATA_RESERVE][DATA_CAR];
        $dataOrder = $_SESSION[DATA_RESERVE][DATA_ORDER];
        $dataOrder['priceOrder'] = str_replace(',', '.', $dataOrder['priceOrder']);

        SDK::setAccessToken(TOKEN); 

        $preference = new Preference();

        $item = new Item();
        $item->title = $dataCar['modelCar'];
        $item->description = $dataCar['descriptionCar'];
        $item->quantity = 1;
        $item->unit_price = $dataOrder['priceOrder'];
        $item->currency_id = "BRL";
        $item->category_id = "Reserva de carro";

        $preference->items = array($item);

        $preference->back_urls = array(
            "success" => "http://localhost:8000/success",
            "failure" => "http://localhost:8000/failure",
            "pending" => "http://localhost:8000/pending"
        );
       
         // $isCreated = $insertOrder->create($dataOrder);
        // if (!$isCreated) {
        //     return redirect($_SESSION[REDIRECT_BACK_LOGIN]);
        // }
        $preference->save();
        if($preference->error === null){
            
        }
        dd($preference);
    }
}
