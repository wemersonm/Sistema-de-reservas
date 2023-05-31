<?php

namespace app\Controllers;

use app\Core\TemplateView;

class PaymentStatusController extends TemplateView
{
    public function success()
    {
        $data = [];
        $this->view('success', $data, "Reserva");
    }
    public function failure()
    {
        $data = [];
        $this->view('failure', $data, "Reserva");
    }
    public function pending()
    {
        $data = [];
        $this->view('pending', $data, "Reserva");
    }
}
