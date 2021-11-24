<?php
namespace LawnMower\Rules;

use LawnMower\Rule;

class Digits extends Rule {

    private function getNumber($value){
		return ($value == (int) $value) ? (int) $value : (float) $value;
	}

    public function isValid():bool {
        $size = $this->getNumber(array_pop($this->params));

		return !preg_match('/[^0-9]/', $this->value) && strlen((string) $this->value) == $size;
    }
}