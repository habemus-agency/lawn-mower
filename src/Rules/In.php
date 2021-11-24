<?php
namespace LawnMower\Rules;

use LawnMower\Rule;

class In extends Rule {

    public function isValid():bool {
        if(in_array($this->value,$this->params)){
			return true;
		}

		return false;
    }
}