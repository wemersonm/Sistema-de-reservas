<?php

namespace app\Support;

use MercadoPago\Item;
use MercadoPago\Preference;
use MercadoPago\SDK;

class Payment
{


    public static function pay(array $dataCar, array $dataOrder)
    {
        
        $TOKEN = $_ENV['API_KEY_MERCADOPAGO'];
        SDK::setAccessToken($TOKEN);
        
        $init_price = str_replace('.', '', $dataOrder['amountReservation']);
        $init_price = str_replace(',', '.', $init_price);

        $preference = new Preference();

        $item = new Item();
        $item->title = $dataCar['modelCar'];
        $item->description = $dataCar['descriptionCar'];
        $item->quantity = 1;
        $item->unit_price =  $init_price;
        $item->currency_id = "BRL";
        $item->category_id = "Reserva de carro";

        $preference->items = array($item);

        $preference->back_urls = array(
            "success" => "http://localhost:8000/success",
            "failure" => "http://localhost:8000/failure",
            "pending" => "http://localhost:8000/pending"
        );
        $preference->auto_return = 'approved';
        $preference->save();
        return $preference;
    }
}
