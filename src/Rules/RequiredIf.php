<?php
namespace LawnMower\Rules;

use LawnMower\Rule;
use LawnMower\Components\File;

class RequiredIf extends Rule {

    protected $error_message = '###FIELD### is required.';
	protected $require_fields = true;

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
				$compare_value = $this->params[1];

				if($other_field->value instanceof File){
					if($other_field->value->getFilename() == $compare_value){
						return $this_field->isValid();
					}
				}else{
					if($other_field->value == $compare_value){
						return $this_field->isValid();
					}
				}

				return true;
			}


			return $this_field->isValid();
		}
	

		return true;
    }
}