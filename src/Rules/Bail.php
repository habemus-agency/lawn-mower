<?php
namespace LawnMower\Rules;

use LawnMower\Rule;

class Bail extends Rule {

    public function isValid():bool {
        return true;
    }
}