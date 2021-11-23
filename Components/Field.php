<?php
namespace LawnMower\Components;

use LawnMower\Rules\Required;
use LawnMower\Rules\Nullable;
use LawnMower\Rules\Bail;

class Field {
    protected $name = '';
    protected $value;
    public $is_valid = true;
    private $is_nullable = false;
    private $is_bail = false;
    private $is_empty = true;
    private $rules = [];

    public function __construct(string $name,$value){
        $this->name = $name;
        $this->value = $value;

        $required = new Required();
        $required->setValue($this->value);

        $this->is_empty = !$required->isValid();
    }

    public function setRules(array $rules = []){
        $this->rules = $rules;

        foreach ($rules as $rule) {
            $rule->setName($this->name);
            $rule->setValue($this->value);

            if($rule instanceof Nullable){
                $this->is_nullable = true;
            }

            if($rule instanceof Bail){
                $this->is_bail = true;
            }
        }
    }

    public function getRules(){
        return $this->rules;
    }

    public function getValue(){
        return $this->value;
    }


    public function isNullable(){
        return $this->is_nullable == true;
    }

    public function isBail(){
        return $this->is_bail == true;
    }

    public function isEmpty(){
        return $this->is_empty == true;
    }

}