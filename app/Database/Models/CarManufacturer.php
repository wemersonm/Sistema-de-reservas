<?php

namespace app\Database\Models;

class CarManufacturer
{
    protected string $table = "car_manufacturer";

   

    protected function getTable()
    {
        return $this->table;
    }
}