<?php
namespace LawnMower\Rules;

use LawnMower\Rule;

class Recaptcha extends Rule {

    public function isValid():bool {

        $secret = array_pop($this->params);

        if(empty($secret)){
            throw new \InvalidArgumentException('Missing secret key');
        }

        if(empty($this->value)){
            return false;
        }

        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$this->value);
        $responseData = json_decode($verifyResponse);

        if($responseData->success){
            return true;
        }

        return false;
    }
}