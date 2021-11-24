<?php
namespace LawnMower\Rules;

use LawnMower\Rule;

class In extends Rule {

    protected $error_message = "###FIELD### must be ###PARAMS###.";

    public function isValid():bool {
        if(in_array($this->value,$this->params)){
			return true;
		}

		return false;
    }
}