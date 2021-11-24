<?php
namespace LawnMower\Rules;

use LawnMower\Rule;

class TypeDate extends Rule {

    protected $error_message = "###FIELD### is not a valid Date.";

    public function isValid():bool {

        if ($this->value instanceof \DateTimeInterface) {
            return true;
        }

        if ((! is_string($this->value) && ! is_numeric($this->value)) || strtotime($this->value) === false) {
            return false;
        }

        $date = date_parse($this->value);

        return checkdate($date['month'], $date['day'], $date['year']);
    }
}