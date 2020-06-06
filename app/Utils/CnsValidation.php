<?php

namespace App\Utils;

class CnsValidation
{
    

    public function validate($attribute, $value, $parameters, $validator)
    {
        return $this->isValidate($attribute, $value);
    }

    protected function isValidate($attribute, $value)
    {
        if (preg_match("/[1-2]\d{10}00[0-1]\d/", $value) || preg_match("/[7-9]\d{14}/", $value)) {
            return $this->somaPonderada($value) % 11 == 0;
        }
        return false;
    }

    private function somaPonderada($value)
    {
        $value_char = str_split($value);
        $value_char_lenght = sizeof($value_char);
        $soma = 0;
        for ($i = 0; $i < $value_char_lenght; $i++) {
            $soma += intval($value_char[$i], 10) * (15 - $i);
        }
        return $soma;
    }
}
