<?php

namespace app\Database\Models;

class User extends Model
{
    private string $table = 'users';
    protected function getTable(){
        return $this->table;
    }

    
}