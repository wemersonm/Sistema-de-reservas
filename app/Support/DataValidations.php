<?php

namespace app\Support;

use app\Database\Filters;
use app\Database\Models\ModelGeneric;

class DataValidations
{

    public static function validateDatetimeReserve(string $fullDatePickupTime, string $fullDateReturnTime, string $timeAdvance)
    {
        if ($fullDatePickupTime < $timeAdvance) {
            FlashMessages::setFlashMessage('dateReserve', "A data de retirada deve ser 1 hora de antecedência !");
            return false;
        }
        if ($fullDatePickupTime > $fullDateReturnTime || $fullDatePickupTime == $fullDateReturnTime) {
            FlashMessages::setFlashMessage('dateReserve', "A data de devolução deve nao pode ser antes ou igual da de coleta");
            return false;
        }
        return true;
    }

    public static function fullDate(string $date, string $hour)
    {
        return $date . ' ' . $hour;
    }

    public static function dateDiff(string $finalTimestamp, string $startTimestamp): array
    {
        $diff = $finalTimestamp - $startTimestamp;

        $days = floor($diff / (60 * 60 * 24));
        $hour = floor(($diff % ((60 * 60 * 24))) / (60 * 60));
        $minutes = floor(($diff % (60 * 60)) / 60);
        return [$days, $hour, $minutes];
    }
    public static function calculatePriceReserve(string $days, string $hours, $minutes, string $pricePerDayCar)
    {
        $priceTotal = 0;
        if ($days >= 1) {
            $priceTotal += $days * $pricePerDayCar;
            $priceTotal += ($hours / 24.0) * $pricePerDayCar;
        } else {
            $priceTotal = $pricePerDayCar;
        }
        return $priceTotal = number_format($priceTotal, 2, ',', '.');
    }


    public static function carAvailable(string $pickupDate, string $pickupHour, string $idCar)
    {
        $pickupHourAdvance = date("H:i", strtotime('-4 hours', strtotime($pickupHour)));
        
        $reservedCars = new ModelGeneric('reserved_cars');
        $filters = new Filters;
        $filters->where('idCar', ' = ', $idCar, "AND");
        $filters->where('returnDate', '>', $pickupDate, "AND");
        $filters->where('returnHour', '>', $pickupHourAdvance);

        $reservedCars->setFilters($filters);
        $existsReserve = $reservedCars->findBy();
        return !empty($existsReserve) ? true : false;
    }
}
