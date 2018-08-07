<?php

namespace App\Tests\UI\Form\Type;

use App\Domain\DTO\UserRegistrationDTO;
use App\UI\Form\Type\RegisterType;
use Symfony\Component\Form\Test\TypeTestCase;

class RegisterTypeTest extends TypeTestCase
{
    public function testWithGoodData()
    {
        $form = $this->factory->create(RegisterType::class);

        $form->submit([
            'firstname' => 'Toto',
            'lastname' => 'Dupont',
            'username' => 'Tintin',
            'email' => 'toto@gmail.com',
            'password' => 'coco21'
        ]);

        static::assertTrue(
            $form->isSubmitted()
        );

        static::assertInstanceOf(UserRegistrationDTO::class,
            $form->getData()
        );

        static::assertTrue(
            $form->isValid()
        );
    }
}