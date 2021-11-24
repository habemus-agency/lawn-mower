<?php
namespace LawnMower\Rules;

use LawnMower\Rule;

class Numeric extends Rule {

    public function isValid():bool {
        if(is_numeric($this->value)){
			return true;
		}

		return false;
    }
}