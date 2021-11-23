<?php
namespace LawnMower;

use LawnMower\Components\Field;


class Validator {
    private $input = [];
    private $errors = [];
    private $is_valid = false;

    protected $rules_mapping = [];
    protected $errors_mapping = [];

    public function __construct(){
        $this->rules_mapping = require_once(__DIR__ .'/RulesMapping.php');
    }


    public function validate(array $field_rules = []){

        $output = [];

        $this->is_valid = true;
		$this->errors = [];

        foreach($field_rules as $field => $multiple_rules){

			$current = new Field($field,array_key_exists($field,$this->input) ? $this->input[$field] : null);
            $current->is_valid = true;
            $current->setRules($this->getRulesList($multiple_rules));

            foreach ($current->getRules() as $rule) {

                //validate if field is not nullable or if nullable but data is present
                if(!$current->isNullable() or ($current->isNullable() and !$current->isEmpty())){
                    
                    if(!$rule->isValid()){
                        $current->is_valid = false;
                        $this->errors [$field][get_class($rule)] = $rule->getErrorMessage();

                        if($current->isBail()){
                            break 1;
                        }
                    }
                }
            }


            if(!$current->is_valid){
                $this->is_valid = false;
            }
			
            if(!$current->isEmpty() and $current->is_valid){
                $output[$field] = $this->input[$field];
            }

		}

		return $output;
    }


    public function setData(array $data = []){
        $this->input = $data;
    }


    public function isValid(){
        return $this->is_valid == true;
    }

    public function getErrors(){
        return $this->errors;
    }


    private function getRulesList($rules = []){

        if(is_string($rules)){
            $rules = explode('|',$rules);
        }elseif (is_array($rules)) {
            $rules;
        }else{
            throw new \Exception("Rules list not valid or empty");
        }

        $list = [];

        foreach ($rules as $rule) {

            if($rule instanceof Rules\Rule){

                $list [] = $rule;

            }elseif(is_string($rule)){

                $params = $this->getRuleParams($rule);
                $rule_instance = $this->getRuleInstance($rule);

                if(!($rule_instance instanceof Rules\Rule)){
                    throw new \InvalidArgumentException("Rule '$rule' doesn't exist.");
                }

                $rule_instance->setParams($params);

                $list [] = $rule_instance;
            }else{
                throw new \InvalidArgumentException("Rule is of invalid type.");
            }

        }


        return $list;
    }


    private function getRuleParams(string &$rule){
		$params = [];

		$param = explode(':',$rule);
		$rule = array_shift($param);

		if(!empty($param)){
			$params = explode(',',$param[0]);
		}

		return $params;
	}


    private function getRuleInstance(string $rule){

        if(!empty($rule)){
            if(array_key_exists($rule,$this->rules_mapping)){
                return new $this->rules_mapping[$rule];
            }
        }

        return null;
    }

}