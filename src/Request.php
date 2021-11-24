<?php
namespace LawnMower;

class Request {

    protected $files;
    protected $get;
    protected $post;
    protected $validator;

    public function __construct(Validator $validator = null){
        $this->get = $_GET;
        $this->post = $_POST;
        $this->validator = $validator ? $validator : new Validator();
        $this->files = [];

        foreach ($_FILES as $key => $value) {
            $this->files [$key] = new FileUpload($value);
        }
    }


    public function validate(array $rules){
        $this->validator->setData(array_merge($this->get,$this->post,$this->files));
        return $this->validator->validate($rules);
    }

    public function errors() {
        return $this->validator->getErrors();
    }

    public function isValid() {
        return $this->validator->isValid();
    }

    public function all(){
        return array_merge($this->get,$this->post,$this->files);
    }

    public function only(array $keys){
        $all = $this->all();
        $only = [];

        foreach ($keys as $key) {
            if(array_key_exists($key,$all)){
                $only[$key] = $all[$key];
            }
        }

        return $only;
    }
}