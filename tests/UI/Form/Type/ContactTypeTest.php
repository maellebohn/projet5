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

        $dto = new NewContactFormSubmittedDTO('toto', 'toto@gmail.com', 'Hello !');

        $form->submit($dto);

        static::assertTrue(
            $form->isSubmitted()
        );

        static::assertSame($dto,
            $form->getData()
        );

        static::assertTrue(
            $form->isValid()
        );
    }
}