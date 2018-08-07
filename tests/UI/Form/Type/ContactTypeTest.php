<?php

namespace App\Tests\UI\Form\Type;

use App\Domain\DTO\NewContactFormSubmittedDTO;
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
            'message' => 'hello'
        ]);

        static::assertTrue(
            $form->isSubmitted()
        );

        static::assertInstanceOf(NewContactFormSubmittedDTO::class,
            $form->getData()
        );

        static::assertTrue(
            $form->isValid()
        );
    }
}