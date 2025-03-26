<?php
namespace LawnMower;

abstract class Rule {
    protected $name;
    protected $value;
    protected $params;
    protected $require_fields = false;
    protected $fields = [];
    protected $error_message = '###FIELD### is invalid.';

    abstract public function isValid():bool;

    public function __construct(array $params = []){
        $this->params = $params;
    }

    public function setParams(array $params){
        $this->params = $params;
    }

    public function setValue($value){
        $this->value = $value;
    }

    public function setName(string $name){
        $this->name = $name;
    }

    public function requireFields():bool {
        return $this->require_fields == true;
    }

    public function setFields(&$input){ //reference
        $this->fields = $input;
    }

    public function getField(string $name){
        if(array_key_exists($name,$this->fields)){
            return $this->fields[$name];
        }

        return null;
    }

    public function getErrorMessage():string {

		$field = str_replace(['_','-'],' ',$this->name);
		$message = str_replace('###FIELD###',ucfirst($field),$this->error_message);
		$message = str_replace('###PARAMS###',implode(',',$this->params),$message); //TODO: check if params is actually a plain array and not array of stuff

		return $message;
	}

}