<?php

namespace App\Tests\UI\Form\Type;

use App\UI\Form\Type\ContactType;
use Symfony\Component\Form\Test\TypeTestCase;

class ContactTypeTest extends TypeTestCase
{
    public function testWithGoodData()
    {
        $form = $this->factory->create(ContactType::class);

        $form->submit([
            'name' => 'toto',
            'email' => 'toto@gmail.com',
            'message' => 'Hello !'
        ]);

        static::assertTrue(
            $form->isSubmitted()
        );

        static::assertSame([
            'name' => 'toto',
            'email' => 'toto@gmail.com',
            'message' => 'Hello !'
            ],
            $form->getData()
        );

        static::assertTrue(
            $form->isValid()
        );
    }
}