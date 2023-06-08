<?php

namespace app\Support;

class DocumentValidator
{
    private string $cpf;
   
    public function __construct(string $cpf)
    {
        $this->cpf = $cpf;
    }

    public function CpfValidate(string $cpf)
    {
        $document = '';
        $document = str_replace(['.', '-'], '', $cpf);
        
        if(strlen($document) != 11){
            return false;
        }
        $characterCounts = count_chars($document, 1);
        if(count($characterCounts) === 1){
            return false;
        }

        $stringArray = str_split($document);
        // first digit
        $count = 0;
        for ($i = 0, $c = 10; $i < 9; $i++, $c--) {
            $count += $c * $stringArray[$i];
        }
        $division = floor($count / 11);
        $restDivision = floor($count % 11);
        $firstDigit = 0;
        if ($restDivision >= 2) {
            $firstDigit = 11 - $restDivision;
        }
        
        //second digit
        $count = 0;
        for ($i = 0, $c = 11; $i < 10; $i++, $c--) {
            $count += $c * $stringArray[$i];
        }
        $division = floor($count / 11);
        $restDivision = floor($count % 11);
        $secondDigit = 0;
        if ($restDivision >= 2) {
            $secondDigit = 11 - $restDivision;
        }
        
        $stringArray = array_slice($stringArray, 0, -2);
        array_push($stringArray,...[$firstDigit.'', $secondDigit.'']);
        
        return join("",$stringArray);
       
    }

    public function isValid()
    {
        return $this->cpf == $this->CpfValidate($this->cpf) ? true : false;
    }


}
