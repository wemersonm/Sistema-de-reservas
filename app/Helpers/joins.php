<?php

function joinsCar(object $car){
    $car->multipleJoin('car_manufaturer', 'cars.idManufature', '=', 'car_manufaturer.idManufature', 'inner join');
    $car->multipleJoin('type_cars', 'cars.typeCar', '=', 'type_cars.idTypeCar', 'inner join');
    $car->multipleJoin('car_transmission', 'cars.transmissionCar', '=', 'car_transmission.idTransmissionCar', 'inner join');
    $car->multipleJoin('car_fuel', 'cars.typeFuelCar', '=', 'car_fuel.idFuelCar', 'inner join');
    // $car->multipleJoin('reserved_cars', 'cars.idCar', '=', 'reserved_cars.idCar', 'left join');
    return $car;
}