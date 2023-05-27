<?php

namespace app\Database\Models;


class Car extends Model
{
    protected string $table = "cars";

    protected function getTable()
    {
        return $this->table;
    }
}
