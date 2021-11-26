# LawnMower: Data validation

LawnMower is a light-weight library for GET,POST and FILES validation, based on Laravel and Zend validators.
It's main components are the `Request`,`Validator`,`Rule` and `FileUpload` objects.


## Installation

```

$ composer require apdev/lawn-mower

```

## Basic Usage

```php
<?php

use LawnMower\Request;


$request = new Request();

$valid_data = $request->validate([
    'field_name' => 'rule_name|other_rule_name:with_param|rule_name',
    'other_field' => [
        'rule_name',
        'some_other_rule',
        $rule_instance, //instance of LawnMower\Rule::class
        ...
    ],
    ...
]);


if($request->isValid()){
    //do stuff
}else{
    $errors = $request->errors();
    $input = $request->all();
    $specific_fields = $request->only([ 'field_name', 'some_other_field', ... ]);
}

```

### The Request Object

The Request object automatically collects all `$_GET`,`$_POST` and `$_FILES` data and passes it to a `Validator::class` instance.
`$_FILES` are handled as `FileUpload::class` instances, a class that conveniently handles file uploads. 

## Rules
### Available rules:

*Note: the order is not relevant, all rules are evaluated before execution.*

* **required** - the field must be present and not null, empty string, empty array or empty file.
* **nullable** - the field can be omitted.
* **bail** - after this filter, stop executing checks as soon as a filter fails.
* **email** - field must be a valid e-mail.
* **url** - field must be a valid url.
* **alpha_num** - field must contain only letters and numbers.
* **alpha** - field must contain only letters.
* **numeric** - field must contain only numbers.
* **digits:*size*** - field must contain only numbers characters and must be exact *size* long.
* **mimes:*extension1,extension2,...*** - field must be a valid FileUpload and match the specified *extensions*. Extension is guessed by file Mime Type and it's binary data.
* **file** - field must be valid file.
* **size:*value*** - field size must be of exact *value*. Works with arrays, strings and files.
* **in:*value1,value2,...*** - field must be one of the specified values.
* **gte:*value*** - field must be greater than or equal to *value*. Works with numbers.
* **gt:*value*** - field must be greater than *value*. Works with numbers.
* **lt:*value*** - field must be less than *value*. Works with numbers.
* **lte:*value*** - field must be less than or equal to *value*. Works with numbers.
* **min:*value*** - field must be greater than or equal to *value* in size. Works with arrays and files. 
* **max:*value*** - field must be smaller than or equal to *value* in size. Works with arrays and files. 
* **integer** - field must be a valid integer.
* **boolean** - field must be a valid boolean. Values accepted are `true`,`false`,`0`,`1`,`'true'`,`'false'`.
* **string** - field must be a string.
* **date** - field must be a valid date.
* **slug** - field must contain only lowercase letters, numbers and `-`.
* **recaptcha:*secret*** - field is a Google Recaptcha field, if valid it's automatically removed from validated data.


There are 3 ways to pass `Rules` to `Validator`: let's take a look at a file field.

### By string

```php
...

$valid_data = $request->validate([
    'file_field' => 'required|file|mimes:pdf,docx'
]);

...

```

### By array of strings

```php
...

$valid_data = $request->validate([
    'file_field' => [ 'required', 'file', 'mimes:pdf,docx' ],
]);

...

```

### By array of instances (or a mix of strings and instances)

```php
...

$valid_data = $request->validate([
    'file_field' => [
        'required',
        'file',
        new LawnMower\Rules\Mimes([ 'pdf','docx' ]),
    ],
]);

...

```

The last approach is very useful when you need to pass a `$variable` as a parameter to Rules.
The complete `string => RuleClass` mapping is `RulesMapping.php` file.


### Custom Rules

It's possibile to use custom rules by extending the standard `LawnMower\Rule::class` an passing the instance to the Validator.


```php
<?php
use LawnMower\Rule;

class MyRule extends Rule {

    protected $error_message = "###FIELD### has my custom error message, with ###PARAMS### too.";

    public function isValid():bool {

        echo $this->value; //value to be checked
        echo $this->params; //array of params passed by constructor

        //my stuff goes here

        return true; // or false
    }
}


```


## FileUpload

This class has some handy methods to help you deal with files uploaded via forms.
If the file is not stored via the `$file->store($path)` method it will be automatically deleted with the object destructor.

```php
...

//get instance of LawnMower\FileUpload::class
$upload = $valid_data['file_upload'];

$upload->isEmpty(); //checks if file is empty
$upload->getPath(); //returns full file path
$upload->getFilename(); //returns filename.ext without path
$stored_file = $upload->store("path/to/file/destination"); //stores file and returns a LawnMower\File::class instance;

```

Package developed by apdev, 2021.

#### current v1.0.0