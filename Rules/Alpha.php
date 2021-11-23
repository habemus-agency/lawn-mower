<?php
namespace LawnMower\Rules;

use LawnMower\Rule;

class Alpha extends Rule {

    public function isValid():bool {
        return is_string($this->value) && preg_match('/^[\pL\pM]+$/u', $this->value);
    }
}