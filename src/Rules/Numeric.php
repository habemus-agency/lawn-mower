<?php
namespace LawnMower\Rules;

use LawnMower\Rule;

class Numeric extends Rule {

    protected $error_message = "###FIELD### must be numeric.";

    public function isValid():bool {
        if(is_numeric($this->value)){
			return true;
		}

		return false;
    }
}