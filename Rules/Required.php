<?php
namespace LawnMower\Rules;

use LawnMower\Components\File;

class Required extends Rule {

    protected $error_message = '###FIELD### is required.';

    public function isValid():bool {

        if (is_null($this->value)) {
			return false;
		} elseif (is_string($this->value) && trim($this->value) === '') {
			return false;
		} elseif ((is_array($this->value) || $this->value instanceof Countable) && count($this->value) < 1) {
			return false;
		}elseif ($this->value instanceof File){
			return !$this->value->isEmpty();
		}

		return true;
    }
}