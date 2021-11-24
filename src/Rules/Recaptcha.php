<?php
namespace LawnMower\Rules;

use LawnMower\Rule;

class Recaptcha extends Rule {

    protected $error_message = "Invalid Recaptcha.";

    public function isValid():bool {
        if(empty($this->params)){
			throw new \InvalidArgumentException("Missing params");
		}

        $secret = $this->params[0];

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