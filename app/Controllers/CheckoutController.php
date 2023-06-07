<?php

namespace app\Controllers;

use app\Core\TemplateView;
use app\Database\Models\ModelGeneric;
use app\Support\Csfr;
use app\Support\DataValidations;
use app\Support\Payment as SupportPayment;

use app\Support\RequestType;
use app\Support\Validate;
use app\Support\ValidationsDataSessions;


class CheckoutController extends TemplateView
{
    public function __construct()
    {
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
            return redirect($_SESSION[REDIRECT_BACK]['previus']);
            die;
        }

        $fullDatePickup = DataValidations::fullDate($validations['pickupDate'], $validations['pickupHour']);
        $fullDateReturn = DataValidations::fullDate($validations['returnDate'], $validations['returnHour']);

        $fullDatePickupTimestamp =  strtotime($fullDatePickup);
        $fullDateReturnTimestamp =  strtotime($fullDateReturn);

      

        $isDateValide = DataValidations::validateDatetimeReserve($fullDatePickupTimestamp, $fullDateReturnTimestamp);
        if (!$isDateValide) {
            return redirect($_SESSION[REDIRECT_BACK]['previus']);
            die;
        }

         
        $issetSessionData = ValidationsDataSessions::issetDataCarInSession();
        if (!$issetSessionData) {
            return redirect("/error");
            die;
        }
        
        $carAvailable = DataValidations::carAvailable($validations['pickupDate'], $validations['pickupHour'], $validations['returnDate'], $validations['returnHour'], $_SESSION[DATA_RESERVE][DATA_CAR]['idCar']);

        if (!$carAvailable) {
            
            return redirect($_SESSION[REDIRECT_BACK]['previus']);
            die;
        }

        if (!isLogged()) {
            return redirect("/login");
            die;
        }

        $dataUser = dataUserLogged();

        $dataOrder = [];
        $_SESSION[DATA_RESERVE][DATA_ORDER] = &$dataOrder;
        $dataCar = $_SESSION[DATA_RESERVE][DATA_CAR];

        list($days, $hours, $minutes) = DataValidations::dateDiff($fullDateReturnTimestamp, $fullDatePickupTimestamp);
        $pricePerDayCar = floatval($dataCar['pricePerDayCar']);

        $priceTotal = DataValidations::calculatePriceReserve($days, $hours, $minutes, $pricePerDayCar);

        $dataOrder = [
            'idCar' => $dataCar['idCar'],
            'idUser' => $dataUser['idUser'],
            'pickupDate' => $validations['pickupDate'],
            'pickupHour' => $validations['pickupHour'],
            'returnDate' => $validations['returnDate'],
            'returnHour' => $validations['returnHour'],
            'amountReservation' => $priceTotal,
        ];

        return redirect('/checkout/details');
    }

    public function details() // show info before paying
    {
        if (!isLogged()) {
            return redirect("/login");
            die;
        }

        $issetSessionData = ValidationsDataSessions::issetDataCarAndOrderInSession();
        if (!$issetSessionData) {
            return redirect("/error"); // if delete session on car and order/date/hour

            die;
        }
        
        $data['dataCar'] = $_SESSION[DATA_RESERVE][DATA_CAR];
        $data['dataOrder'] = $_SESSION[DATA_RESERVE][DATA_ORDER];

        $carAvailable = DataValidations::carAvailable($data['dataOrder']['pickupDate'], $data['dataOrder']['pickupHour'], $data['dataOrder']['returnDate'], $data['dataOrder']['returnHour'], $_SESSION[DATA_RESERVE][DATA_CAR]['idCar']);
        
        if (!$carAvailable) {
            return redirect($_SESSION[REDIRECT_BACK]['previus']);
            die;
        }

        $this->view('checkout',  $data, 'Finalizar reserva');
    }

    public function pay()
    {
        $issetSessionData = ValidationsDataSessions::issetDataCarAndOrderInSession();
        if (!$issetSessionData) {
            return redirect("/error"); // if delete session on car and order/date/hour
            die;
        }
        $dataCar = $_SESSION[DATA_RESERVE][DATA_CAR];
        $dataOrder = $_SESSION[DATA_RESERVE][DATA_ORDER];

        $carAvailable = DataValidations::carAvailable($dataOrder['pickupDate'], $dataOrder['pickupHour'], $dataOrder['returnDate'], $dataOrder['returnHour'], $dataOrder['idCar']);

        if (!$carAvailable) {
            return redirect($_SESSION[REDIRECT_BACK]['previus']);
            die;
        }

        $preference = new SupportPayment;
        $preference =  $preference->pay($dataCar, $dataOrder);

        $insertOrder = new ModelGeneric('reserved_cars');

        $dataOrder['PaymentStatus'] = null;
        $dataOrder['ReservationStatus'] = 0;
        $dataOrder['descriptionReservation'] = "Reserva do carro {$dataCar['modelCar']}, NVI:{$dataCar['nviCar']}, do dia/hora: {$dataOrder['pickupDate']}/ {$dataOrder['pickupHour']} até dia/hora {$dataOrder['returnDate']}/ {$dataOrder['returnHour']}";
        $dataOrder['idPreference'] = $preference->id;
        $dataOrder['collectorId'] = $preference->collector_id;
        $dataOrder['paymentId'] = null;
        $dataOrder['externalReference'] = $preference->external_reference;

        $isCreated = $insertOrder->create($dataOrder);

        if (!$isCreated) {
            return redirect("/error");
            die;
        }

        if ($preference->error === null) {
            unset($_SESSION[DATA_RESERVE]);
            return redirect($preference->init_point);
        }
    }
    public function webhook()
    {
        if (RequestType::getRequestType() == "POST") {
            $payload = file_get_contents('php://input');
            $data = json_decode($payload, true);
            $payment = new SupportPayment;
            $payment->updatePaymentReserve($data);
        }
    }
}
