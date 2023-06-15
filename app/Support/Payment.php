<?php

namespace app\Support;

use app\Database\Filters;
use app\Database\Models\ModelGeneric;
use Exception;
use MercadoPago\Item;
use MercadoPago\Payment as MercadoPagoPayment;
use MercadoPago\Preference;
use MercadoPago\Refund;
use MercadoPago\SDK;

class Payment
{
    private string $token = '';

    public function __construct()
    {
        try {
            $this->token = $_ENV['API_KEY_MERCADOPAGO'] ?? '';
            if ($this->token) {
                SDK::setAccessToken($this->token);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function pay(array $dataCar, array $dataOrder)
    {

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

        $payment = new MercadoPagoPayment;
        $dataPayment = $payment::find_by_id($idPayment);
        return $dataPayment;
    }

    public  function findPreference(string $idPreference)
    {

        $payment = new Preference();
        $dataPreference = $payment::find_by_id($idPreference);
        return $dataPreference;
    }

    public function updateCancellPayment(string $idPayment)
    {
        $payment = new MercadoPagoPayment();

        $dataPayment = $payment->find_by_id($idPayment);

        if ($dataPayment->status != 'cancelled') {
            $dataPayment->status = "cancelled";
            $dataPayment->update();
        }
        return $dataPayment;
    }
    public function refoundTotal(string $idPayment)
    {
        $refund = new Refund();
        $refund->payment_id = $idPayment;
        $refund->save();
        return $refund;
    }
    public function updatePaymentReserve(array $data)
    {
        $idPayment = $data['data']['id'];
        $collectorId = $data['user_id'];

        if ($data['type'] == 'payment' && $data['action'] == 'payment.created') {
            $dataPayment = $this->findPayment($idPayment);

            $externalReference = $dataPayment->external_reference;

            $reservedCars = new ModelGeneric('reserved_cars');
            $car = new ModelGeneric('cars');
            $user = new ModelGeneric('users');
            $ttt = new ModelGeneric('testes');


            $filters = new Filters;
            $filterCar = new Filters;
            $filterUser = new Filters;

            $filters->where('externalReference', '=', $externalReference);
            $reservedCars->setFilters($filters);
            $dataReserve = $reservedCars->findBy();

           

            $filterCar->where('idCar', "=", $dataReserve['idCar']);
            $car->setFilters($filterCar);
            $dataCar = $car->findBy();

           

            $filterUser->where('idUser', '=', $dataReserve['idUser']);
            $user->setFilters($filterUser);
            $dataUser = $user->findBy();

           

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
                $return =  $reservedCars->update('externalReference', $externalReference, $data) ? true : false;

                if ($return) {
                    $email = new Email();
                    $dataTemplate = [
                        'name' => $dataUser['nameUser'],
                        'nameCar' => $dataCar['modelCar'],
                        'amountPrice' => $dataReserve['amountReservation'],
                        'pickupDate' => date("d/m/Y \á\s H:i", strtotime($dataReserve['pickupDate'] . ' ' . $dataReserve['pickupHour'])),
                        'returnDate' => date("d/m/Y \á\s H:i", strtotime($dataReserve['returnDate'] . ' ' . $dataReserve['returnHour'])),
                    ];
                    $sent  = $email->setFrom('minhaempresa@alguma.com', "Car Reserve Express")
                        ->setTo($dataUser['emailUser'], $dataUser['nameUser'])->setMessage("")
                        ->setTemplate('reserve', $dataTemplate)
                        ->setSubject("Reserva de carro")
                        ->send();
                }
                return $return;
            }
        }
    }
}
