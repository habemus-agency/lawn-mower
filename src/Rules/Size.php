<?php
namespace LawnMower\Rules;

use LawnMower\Rule;
use LawnMower\Components\File;

class Size extends Rule {

    private function getNumber($value){
		return ($value == (int) $value) ? (int) $value : (float) $value;
	}

    public function isValid():bool {
        $size = $this->getNumber(array_pop($this->params));

		if($this->value instanceof File){
			return $this->value->getSize() == $size;
		}

		if(is_array($this->value)){
			return count($this->value) == $size;
		}


		if(is_string($this->value)){
			return strlen($this->value) == $size;
		}

		return false;
    }
}