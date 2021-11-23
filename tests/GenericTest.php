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
        ]);

        $validatd = $validator->validate([
            'name' => 'required|max:25',
            'email' => 'required|email',
            'url' => 'required|url',
            'date' => 'nullable|date',
        ]);

        var_dump($validator->isValid());
        echo "<pre>";
        var_dump($validated);
        echo "</pre>";
    }
}