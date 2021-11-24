<?php
namespace LawnMower\Rules;

use LawnMower\Rule;

class Boolean extends Rule {

    protected $acceptable = [true, false, 0, 1, '0', '1'];

    public function isValid():bool {

        if(is_string($this->value)){
			if ($this->value === 'true') {
				$this->value = true;
			} elseif ($this->value === 'false') {
				$this->value = false;
			}
		}

        if(in_array($this->value, $this->acceptable, true)){
			return true;
		}

		return false;
    }

}