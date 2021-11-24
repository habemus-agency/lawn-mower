<?php
namespace LawnMower\Rules;

use LawnMower\Rule;

class Slug extends Rule {

    public function isValid():bool {
       return preg_match('/^[a-z0-9\-]/',$this->value);
    }
}