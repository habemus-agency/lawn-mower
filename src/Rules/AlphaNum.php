<?php
namespace LawnMower\Rules;

use LawnMower\Rule;

class AlphaNum extends Rule {

    protected $error_message = "###FIELD### must be alphanumeric.";

    public function isValid():bool {
        if (! is_string($this->value) && ! is_numeric($this->value)) {
			return false;
		}

		return preg_match('/^[\pL\pM\pN]+$/u', $this->value) > 0;
    }
}