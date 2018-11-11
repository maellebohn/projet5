<?php

namespace App\Tests\UI\Form\Type;

use App\UI\Form\Type\LoginType;
use Symfony\Component\Form\Test\TypeTestCase;

class LoginTypeTest extends TypeTestCase
{
    public function testWithGoodData()
    {
        $form = $this->factory->create(LoginType::class);

        $form->submit([
            'username' => 'toto',
            'password' => 'coco'
        ]);

        static::assertTrue(
            $form->isSubmitted()
        );

        static::assertTrue(
            $form->isValid()
        );
    }
}