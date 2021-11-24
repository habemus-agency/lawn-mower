<?php
namespace LawnMower\Rules;

use LawnMower\Rule;

class TypeInteger extends Rule {

    public function isValid():bool {
        if(filter_var($this->value, FILTER_VALIDATE_INT) !== false){

			return true;
		}

		return false;
    }
}