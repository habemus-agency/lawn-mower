<?php
namespace LawnMower\Components;

use LawnMower\Rules\Required;
use LawnMower\Rules\Nullable;
use LawnMower\Rules\Bail;
use LawnMower\Rules\Recaptcha;
use LawnMower\Rules\Present;

class Field {
    protected $name = '';
    protected $value;
    public $is_valid = true;
    private $is_nullable = false;
    private $is_bail = false;
    private $is_empty = true;
    private $is_skippable = false;
    private $is_present = false;
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

            if($rule instanceof Recaptcha){
                $this->is_skippable = true;
            }

            if($rule instanceof Present){
                $this->is_present = true;
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

    public function isSkippable(){
        return $this->is_skippable == true;
    }

    public function isPresent(){
        return $this->is_present == true;
    }

}