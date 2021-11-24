<?php
namespace LawnMower\Rules;

use LawnMower\Rule;

class TypeArray extends Rule {

    protected $error_message = "###FIELD### is not an array.";

    public function isValid():bool {
        if(is_array($this->value)){
            return true;
        }

        return false;
    }
}