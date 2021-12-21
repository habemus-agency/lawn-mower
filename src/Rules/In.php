<?php
namespace LawnMower\Rules;

use LawnMower\Rule;

class In extends Rule {

    protected $error_message = "###FIELD### must be ###PARAMS###.";

    public function isValid():bool {

        if(is_array($this->value)){
            return !array_diff($this->value, $this->params);
        }

        if(in_array($this->value,$this->params)){
            return true;
        }

		return false;
    }
}