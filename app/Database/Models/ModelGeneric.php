<?php

namespace app\Database\Models;

class ModelGeneric extends Model
{
    protected string $table = '';

    public function __construct(string $table)
    {
        $this->table = $table;
    }
  
    protected function getTable(){
        return $this->table;
    }
}