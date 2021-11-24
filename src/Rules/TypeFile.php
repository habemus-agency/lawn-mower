<?php
namespace LawnMower\Rules;

use LawnMower\Rule;
use LawnMower\Components\File;

class TypeFile extends Rule {

    protected $error_message = "###FIELD### is not a file.";

    public function isValid():bool {
        return ($this->value instanceof File);
    }
}