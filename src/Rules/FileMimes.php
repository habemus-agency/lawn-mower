<?php
namespace LawnMower\Rules;

use LawnMower\Rule;
use LawnMower\Components\File;

class FileMimes extends Rule {

    protected $phpExtensions = [
        'php', 'php3', 'php4', 'php5', 'phtml',
    ];

    private function is_php_file(){

        if (in_array($this->value->getExtension(),$this->phpExtensions)) {
            return true;
        }

        return false;
    }

    public function isValid():bool {
        if(!($this->value instanceof File)){
            return false;
        }

        //exclude unwanted php file upload
		if (!in_array('php', $this->params)) {
			if($this->is_php_file($this->value)){
				return false;
			}
		}

		foreach ($this->params as $type) {
			if ($this->value->getExtension() == $type) {
				return true;
			}

		}

		return false;
    }
}