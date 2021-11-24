<?php
namespace LawnMower\Rules;

use LawnMower\Rule;

class TypeString extends Rule {

	protected $error_message = "###FIELD### is not a string.";

    public function isValid():bool {
		if(is_string($this->value)){

			return true;
		}

		return false;
    }
}