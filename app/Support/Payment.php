<?php

namespace app\Support;

use app\Database\Filters;
use app\Database\Models\ModelGeneric;
use MercadoPago\Item;
use MercadoPago\Payment as MercadoPagoPayment;
use MercadoPago\Preference;
use MercadoPago\SDK;

class Payment
{
    private string $token = '';

    public function __construct()
    {
        $this->token = $_ENV['API_KEY_MERCADOPAGO'] ?? '';
    }

    public function pay(array $dataCar, array $dataOrder)
    {
        $TOKEN = $this->token;
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
        $externalReference = uniqid($dataOrder['idUser']);
        $preference->external_reference = $externalReference;

        $preference->save();
        return $preference;
    }

    public  function findPayment(string $idPayment)
    {

        $TOKEN = $this->token;
        SDK::setAccessToken($TOKEN);
        $payment = new MercadoPagoPayment;
        $dataPayment = $payment::find_by_id($idPayment);
        return $dataPayment;
    }

    public  function findPreference(string $idPreference)
    {

        $TOKEN = $this->token;
        SDK::setAccessToken($TOKEN);
        $payment = new Preference();
        $dataPreference = $payment::find_by_id($idPreference);
        return $dataPreference;
    }

    public function updatePaymentReserve(array $data)
    {
        $idPayment = $data['data']['id'];
        $collectorId = $data['user_id'];

        if ($data['type'] == 'payment' && $data['action'] == 'payment.created') {
            $dataPayment = $this->findPayment($idPayment); 

            $externalReference = $dataPayment->external_reference;
           
            $reservedCars = new ModelGeneric('reserved_cars');
            $filters = new Filters;
            $filters->where('externalReference', '=', $externalReference);
            $reservedCars->setFilters($filters);
            $dataReserve = $reservedCars->findBy(); 
          
            $carAvailable = DataValidations::carAvailable($dataReserve['pickupDate'], $dataReserve['pickupHour'], $dataReserve['returnDate'], $dataReserve['returnHour'], $dataReserve['idCar']);

            if (!$carAvailable) {
                $dataPayment->status = "cancelled";
                $dataPayment->update();   
            }
            
            $status = $dataPayment->status;
            
            if (!empty($dataReserve['externalReference'])) {
                $data = [
                    'paymentId' => $dataPayment->id,
                    'paymentStatus' => $status
                ];
                if ($status == 'approved') {
                    $data['reservationStatus'] = '1';
                }
                if ($status == 'in_process' || $status == 'pending' || $status == 'cancelled') {
                    $data['reservationStatus'] = '0';
                }
                return $reservedCars->update('externalReference', $externalReference, $data) ? true : false;
            }
        }
    }
}
