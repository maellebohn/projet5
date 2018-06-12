<?php

namespace App\Tests\UI\Form\Type;

use App\Domain\DTO\NewInfoDTO;
use App\UI\Form\Type\AddInfoType;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\HttpFoundation\File\File;

class AddInfoTypeTest extends TypeTestCase
{
    public function testWithGoodData()
    {
        $form = $this->factory->create(AddInfoType::class);

        $dto = new NewInfoDTO('alimentation', 'toto', new File(),'education','bien nourrir ses perroquets');

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