<?php
namespace LawnMower\Rules;

use LawnMower\Rule;

class Email extends Rule {

    public function isValid():bool {
        return filter_var($this->value,FILTER_VALIDATE_EMAIL);
    }
}