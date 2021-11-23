<?php
namespace LawnMower\Rules;

abstract class Rule implements RuleInterface {
    protected $name;
    protected $value;
    protected $params;
    protected $error_message = '###FIELD## is invalid.';

    public function setParams(array $params){
        $this->params = $params;
    }

    public function setValue($value){
        $this->value = $value;
    }

    public function setName(string $name){
        $this->name = $name;
    }

    public function getErrorMessage():string {

		$field = str_replace(['_','-'],' ',$this->name);
		$message = str_replace('###FIELD###',ucfirst($field),$this->error_message);
		//$message = str_replace('###PARAMS###',implode(',',$this->params),$message);

		return $message;
	}
}