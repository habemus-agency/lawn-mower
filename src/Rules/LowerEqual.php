<?php
namespace LawnMower\Rules;

use LawnMower\Rule;
use LawnMower\Components\File;

class LowerEqual extends Rule {

    private function getNumber($value){
		return ($value == (int) $value) ? (int) $value : (float) $value;
	}
    
    public function isValid():bool {
        $param = $this->getNumber(array_pop($this->params));

        if(is_string($this->value)){
            return strlen($this->value) <= $param;
        }elseif($this->value instanceof File){
            return $this->value->getSize() <= $param;
        }

        return $this->value <= $param;
    }

}