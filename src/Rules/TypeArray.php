<?php
namespace LawnMower\Rules;

use LawnMower\Rule;

class TypeArray extends Rule {

    public function isValid():bool {
        if(is_array($this->value)){
            return true;
        }

        return false;
    }
}