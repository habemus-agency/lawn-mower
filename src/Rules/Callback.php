<?php
namespace LawnMower\Rules;

use LawnMower\Rule;

class Callback extends Rule {

    private $callback = null;

    public function __construct(callable $callback){
        $this->callback = $callback;
        $this->params = [];
    }

    public function isValid():bool {
        return call_user_func($this->callback,$this->value,$this->params) == true;
    }
}