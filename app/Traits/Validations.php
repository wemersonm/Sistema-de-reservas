<?php

namespace app\Traits;

use app\Core\Request;
use app\Database\Filters;
use app\Database\Models\ModelGeneric;
use app\Support\DocumentValidator;
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
        if (strlen($value) < $param) {
            FlashMessages::setFlashMessage($field, "Campo deve ter no minimo {$param} caracteres");
            return false;
        }
        return strip_tags($value);
    }

    public function email(string $field, $param = '')
    {

        $value = filter_input(INPUT_POST, $field, FILTER_VALIDATE_EMAIL);
        if (!$value) {
            FlashMessages::setFlashMessage($field, "E-mail inválido");
            return false;
        }
        return strip_tags($value);
    }
    public function unique(string $field, $param = '')
    {
        $value = filter_input(INPUT_POST, $field, FILTER_VALIDATE_EMAIL);

        $users = new ModelGeneric("users");
        $filters = new Filters;
        $filters->where($field, '=', $value);
        $users->setFilters($filters);
        $existsEmail = $users->findBy();

        
        if (!empty($existsEmail)) {
            FlashMessages::setFlashMessage($field, "E-mail já cadastrado no sistema");
            return false;
        }

        return strip_tags($value);
    }
    public function date(string $field, string $params = '')
    {
        $date = Request::input($field);
        $dateTime = strtotime($date);
        if ($dateTime === false) {
            FlashMessages::setFlashMessage($field, "Data invalida");
            return false;
        }
        return date("Y-m-d", $dateTime);
    }
    public function hour(string $field, string $params = '')
    {
        $hour =  Request::input($field);
        $dateTime = strtotime($hour);
        if ($dateTime === false) {
            FlashMessages::setFlashMessage($field, "Hora invalida");
            return false;
        }
        return date("H:i", $dateTime);
    }
    public function cpf(string $field, string $params = '')
    {

        $cpf = Request::input($field);
        $document = new DocumentValidator($cpf);
        if (!$document->isValid()) {
            FlashMessages::setFlashMessage($field, "CPF invalido");
            return false;
        }
        return $cpf;
    }

    public function password(string $field, string $param = '')
    {
        $value = trim(Request::input($field));
        $value = password_hash($value, PASSWORD_DEFAULT);
        return  $value;
    }
}
