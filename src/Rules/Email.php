<?php
namespace LawnMower\Rules;

use LawnMower\Rule;

class Email extends Rule {

    protected $error_message = "###FIELD### is not a valid email address.";

    public function isValid():bool {
        return filter_var($this->value,FILTER_VALIDATE_EMAIL);
    }
}