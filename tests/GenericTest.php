<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use LawnMower\Validator;

final class GenericTest extends TestCase {

    function test()
    {

        $validator = new Validator();

        $validator->setData([
            'name' => "Alberto Piccolo",
            'phone' => "3404148856",
            'email' => 'alberto.piccolo.developer@gmail.com',
            'url' => 'http://test.it',
            'date' => '2022-03-11',
            'array' => 5,
            'date_nulled' => '',
        ]);

        $validated = $validator->validate([
            'name' => 'required|max:25',
            'email' => 'required|email',
            'url' => 'required|url',
            'date' => 'required|date',
            'date_nulled' => 'nullable|date',
            'array' => [
                'nullable',
                new LawnMower\Rules\In([2,3,5,6])
            ],
        ]);

        $this->assertTrue($validator->isValid());
    }
}