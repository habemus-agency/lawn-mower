<?php
namespace LawnMower\Rules;

use LawnMower\Rule;
use LawnMower\Components\File;

class TypeFile extends Rule {

    public function isValid():bool {
        return ($this->value instanceof File);
    }
}