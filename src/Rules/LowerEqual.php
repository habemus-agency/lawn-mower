<?php
namespace LawnMower\Rules;

use LawnMower\Rule;
use LawnMower\Components\File;

class LowerEqual extends Rule {

    protected $error_message = "###FIELD### is bigger than ###PARAMS###.";

    private function getNumber($value){
		return ($value == (int) $value) ? (int) $value : (float) $value;
	}
    
    public function isValid():bool {
        if(empty($this->params)){
			throw new \InvalidArgumentException("Missing params");
		}

        $param = $this->getNumber($this->params[0]);

        if(is_string($this->value)){
            return strlen($this->value) <= $param;
        }elseif($this->value instanceof File){
            return $this->value->getSize() <= $param;
        }

        return $this->value <= $param;
    }

}