<?php

namespace app\Support;

use app\Traits\Validations;
use Exception;

class Validate
{
    use Validations;

    private array $validations = [];

    private function existsParam(string $validation, string $param)
    {
        if (strpos($validation, ":") !== false) {
            list($validation, $param) = explode(":", $validation);
        }
        return [$validation, $param];
    }
    private function existsMethod(string $validation)
    {
        if (!method_exists($this, $validation)) {
            throw new Exception("A validação {$validation} não existe");
        }
    }
    private function returnValidations()
    {
        return in_array(false, $this->validations, true) ? false : $this->validations;
    }
    public function validations(array $data)
    {
        $param = '';
        foreach ($data as $field => $validation) {
            if (!strpos($validation, "|") !== false) {
                list($validation, $param) = $this->existsParam($validation, $param);
                $this->existsMethod($validation);
                $this->validations[$field] = $this->$validation($field, $param);
            } else {
                $separateValidations = explode("|", $validation);
                foreach ($separateValidations as $validation) {
                    list($validation, $param) = $this->existsParam($validation, $param);
                    $this->existsMethod($validation);
                    $this->validations[$field] = $this->$validation($field, $param);
                    if ($this->validations[$field] === false) {
                        break;
                    }
                }
            }
        }
        return $this->returnValidations();
    }
}
