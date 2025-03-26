<?php

return [
    'required' => \LawnMower\Rules\Required::class,
    'nullable' => \LawnMower\Rules\Nullable::class,
    'requiredIf' => \LawnMower\Rules\RequiredIf::class,
    'bail' => \LawnMower\Rules\Bail::class,
    'alpha' => \LawnMower\Rules\Alpha::class,
    'alpha_num' => \LawnMower\Rules\AlphaNum::class,
    'boolean' => \LawnMower\Rules\Boolean::class,
    'digits' => \LawnMower\Rules\Digits::class,
    'email' => \LawnMower\Rules\Email::class,
    'mimes' => \LawnMower\Rules\FileMimes::class,
    'gt' => \LawnMower\Rules\Greater::class,
    'gte' => \LawnMower\Rules\GreaterEqual::class,
    'in' => \LawnMower\Rules\In::class,
    'lt' => \LawnMower\Rules\Lower::class,
    'lte' => \LawnMower\Rules\LowerEqual::class,
    'max' => \LawnMower\Rules\Maximum::class,
    'min' => \LawnMower\Rules\Minimum::class,
    'numeric' => \LawnMower\Rules\Numeric::class,
    'present' => \LawnMower\Rules\Present::class,
    'recaptcha' => \LawnMower\Rules\Recaptcha::class,
    'size' => \LawnMower\Rules\Size::class,
    'slug' => \LawnMower\Rules\Slug::class,
    'array' => \LawnMower\Rules\TypeArray::class,
    'date' => \LawnMower\Rules\TypeDate::class,
    'file' => \LawnMower\Rules\TypeFile::class,
    'integer' => \LawnMower\Rules\TypeInteger::class,
    'string' => \LawnMower\Rules\TypeString::class,
    'url' => \LawnMower\Rules\Url::class,
];