<?php
namespace LawnMower\Components;

interface RuleInterface {
    public function isValid(): bool;
    public function setValue($value);
    public function setParams(array $params);
    public function getErrorMessage():string;
}