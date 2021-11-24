<?php
namespace LawnMower\Rules;

use LawnMower\Rule;

class Slug extends Rule {

    protected $error_message = "###FIELD### must be a valid slug.";

    public function isValid():bool {
       return preg_match('/^[a-z0-9\-]/',$this->value);
    }
}