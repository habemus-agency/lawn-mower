<?php
namespace LawnMower\Rules;

use LawnMower\Rule;

class TypeInteger extends Rule {

    protected $error_message = "###FIELD### is not an integer.";

    public function isValid():bool {
        if(filter_var($this->value, FILTER_VALIDATE_INT) !== false){

			return true;
		}

		return false;
    }
}