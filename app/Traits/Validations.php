<?php

namespace app\Traits;

use app\Core\Request;
use app\Support\FlashMessages;

trait Validations
{

    public function required(string $field, string $param)
    {
        $value = trim(Request::input($field));
        if (empty($value)) {
            FlashMessages::setFlashMessage($field, "Preencha o campo corretamente");
            return false;
        }
        return $value;
    }
    public function maxLen(string $field, string $param)
    {
        $value = trim(Request::input($field));
        if (strlen($value) > $param) {
            FlashMessages::setFlashMessage($field, "Preencha o campo corretamente");
            return false;
        }

        return strip_tags($value);
    }
    public function minLen(string $field, string $param)
    {
        $value = trim(Request::input($field));
        if (strlen($value) != $param || strlen($value) < $param) {
            FlashMessages::setFlashMessage($field, "Preencha o campo corretamente");
            return false;
        }
        return strip_tags($value);
    }

    public function email(string $field, $param){

        $value = filter_input(INPUT_POST,$field, FILTER_VALIDATE_EMAIL);
        if(!$value){
            FlashMessages::setFlashMessage($field,"E-mail inválido");
            return false;
        }
        return strip_tags($value);
    }

    public function date(string $field, string $params = ''){
        $date = Request::input($field);
        $dateTime = strtotime($date);
        if($dateTime === false){
            FlashMessages::setFlashMessage($field,"Data invalida");
            return false;
        }
        return date("Y-m-d",$dateTime);
    }
    public function hour(string $field, string $params = ''){
        $hour =  Request::input($field); 
        $dateTime = strtotime($hour);
        if($dateTime === false ){
            FlashMessages::setFlashMessage($field,"Hora invalida");
            return false;
        }
        return date("H:i",$dateTime);
    }
}
