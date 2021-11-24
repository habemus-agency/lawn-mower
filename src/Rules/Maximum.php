<?php
namespace LawnMower\Rules;

use LawnMower\Rule;
use LawnMower\Components\File;

class Maximum extends Rule {

	protected $error_message = "###FIELD### is bigger than ###PARAMS###.";

    private function getNumber($value){
		return ($value == (int) $value) ? (int) $value : (float) $value;
	}
    
    public function isValid():bool {
		if(empty($this->params)){
			throw new \InvalidArgumentException("Missing params");
		}

		$min = $this->getNumber($this->params[0]);

		if($this->value instanceof File){
			return $this->value->getSize() <= $min;
		}

		if(is_string($this->value)){
			return strlen($this->value) <= $min;
		}

		if(is_array($this->value)){
			return count($this->value) <= $min;
		}

		return $this->value <= $min;
    }

}