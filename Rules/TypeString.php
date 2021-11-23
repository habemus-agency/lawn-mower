<?php
namespace LawnMower\Rules;

use LawnMower\Rule;

class TypeString extends Rule {

    public function isValid():bool {
		if(is_string($this->value)){

			return true;
		}

		return false;
    }
}