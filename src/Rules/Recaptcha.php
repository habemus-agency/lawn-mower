<?php
namespace LawnMower\Rules;

use LawnMower\Rule;

class Recaptcha extends Rule {

    protected $verify_url = "https://www.google.com/recaptcha/api/siteverify";

    public function isValid():bool {

        if(empty($this->params)){
            throw new \InvalidArgumentException("Missing params");
        }

        $data = [
            'secret' => $this->params[0],
            'response' => $this->value,
        ];

        $curl = curl_init($this->verify_url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);

        $responseData = json_decode($response);

        if($responseData->success){
            return true;
        }

        $this->error_message = "Recaptcha Error: " . implode(", ",$responseData->{'error-codes'});

        return false;
    }
}