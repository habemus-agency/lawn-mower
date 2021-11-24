<?php
namespace LawnMower\Rules;

use LawnMower\Rule;

class Digits extends Rule {

    protected $error_message = "###FIELD### must be numeric and of size ###PARAMS###.";

    private function getNumber($value){
		return ($value == (int) $value) ? (int) $value : (float) $value;
	}

    public function isValid():bool {
        if(empty($this->params)){
			throw new \InvalidArgumentException("Missing params");
		}

        $size = $this->getNumber($this->params[0]);

		return !preg_match('/[^0-9]/', $this->value) && strlen((string) $this->value) == $size;
    }
}