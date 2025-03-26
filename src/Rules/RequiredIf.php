<?php
namespace LawnMower\Rules;

use LawnMower\Rule;
use LawnMower\Components\File;

class Required extends Rule {

    protected $error_message = '###FIELD### is required.';
	protected $requires_fields = true;

    public function isValid():bool {

		if(empty($this->params)){
            throw new \InvalidArgumentException("Missing params");
        }

		$other_field_name = $this->params[0];

		$other_field = new Required();
		$other_field->setValue($this->getField($other_field_name));

		

		if($other_field->isValid()){

			$this_field = new Required();
			$this_field->setValue($this->value);

			if(count($this->params) > 1){
				$other_field_value = $params[1];

				return $this_field->isValid() && $this->value == $other_field_value; //TODO: expand to data types
			}


			return $this_field->isValid();
		}
	

		return true;
    }
}