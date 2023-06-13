<?php

namespace app\Support;

use app\Database\Filters;
use app\Database\Models\ModelGeneric;

class ReservationSupport
{
    public static function cancelReserve(string $idReserve)
    {
        $reservations = new ModelGeneric("reserved_cars");
        $filters = new Filters;
        $idUser = $_SESSION[LOGGED]['idUser'];

        $filters->where('idUser', '=', $idUser, "AND");
        $filters->where('idReserve', '=', $idReserve);
        $reservations->setFilters($filters);
        $dataReserve = $reservations->findBy();

        if (count($dataReserve) < 0) {
            return redirect('/reservations');
            die;
        }
        if (!$dataReserve['refund'] != null) {
            return redirect('/reservations');
            die;
        }

        $idPayment = $dataReserve['paymentId'];
        if ($idPayment != null) {
            $payment = new Payment();
            $canceled = $payment->updateCancellPayment($idPayment);
            if ($canceled->status == 'cancelled') {
                $refunded = $payment->refoundTotal($idPayment);
                $reservations->update('idReserve', $idReserve, ['paymentStatus' => 'cancelled', 'reservationStatus' => '0', 'refund' => $refunded->status]);
            }
        } else {
            $reservations->delete();
        }
        return redirect('/reservations');
        die;
    }
}
