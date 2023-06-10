<?php

namespace app\Core;

use Exception;

class Request
{

    public static function input(string $field)
    {
        if (isset($_POST[$field])) {
            return $_POST[$field];
        }
        return throw new Exception("O indice {$field} não existe");
    }

    public static function all()
    {
        return $_POST;
    }
    public static function only(string|array $only)
    {
        if (is_string($only)) {
            return $_POST[$only];
        }
        $all = self::all();
        $allKeys = array_keys($all);
        foreach ($allKeys as $key) {
            if (!in_array($key, $only)) {
                unset($all[$key]);
            }
        }
        return $all;
    }

    public static function excepts(string|array $excepts)
    {
        $all = self::all();
        if (is_string($excepts)) {
            unset($all[$excepts]);
            return $all;
        }
        foreach (array_keys($all) as $key) {
            if (in_array($key, $excepts)) {
                unset($all[$key]);
            }
        }
        return $all;
    }

    public static function file(string $field)
    {
        if(isset($_FILES[$field])){
            return $_FILES;
        }
        return false;
    }


    public static function query(string $query)
    {
        if (isset($GET[$query])) {
            return $GET[$query];
        }
        return throw new Exception("O indice {$query} não existe");
    }
    public static function toJSON(array $json)
    {
        return json_encode($json);
    }
    public static function toArray($json)
    {
        return json_decode($json, true);
    }
}
