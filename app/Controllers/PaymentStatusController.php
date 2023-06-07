<?php

namespace app\Controllers;

use app\Core\TemplateView;

class PaymentStatusController extends TemplateView
{
    public function success()
    {
        $data = [];
        // $data = array(
        //     'Payment' => $_GET['payment_id'],
        //     'Status' => $_GET['status'],
        //     'MerchantOrder' => $_GET['merchant_order_id']
        // );
        // //echo json_encode($respuesta);
        // $path = '../testeWebHook.txt';
        // $content = json_encode($data);
        // $handle = fopen($path, 'w');
        // fwrite($handle, $content);
        // fclose($handle);

        $this->view('success', $data, "Reserva");
    }
    public function failure()
    {
        $data = [];
        // $data = array(
        //     'Payment' => $_GET['payment_id'],
        //     'Status' => $_GET['status'],
        //     'MerchantOrder' => $_GET['merchant_order_id']
        // );
        // $path = '../testeWebHook.txt';
        // $content = json_encode($data);
        // $handle = fopen($path, 'w');
        // fwrite($handle, $content);
        // fclose($handle);
        $this->view('failure', $data, "Reserva");
    }
    public function pending()
    {
        $data = [];
        $this->view('pending', $data, "Reserva");
    }
}
