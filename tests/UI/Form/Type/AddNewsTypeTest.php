<?php

namespace App\Tests\UI\Form\Type;

use App\Domain\DTO\NewNewsDTO;
use App\UI\Form\Type\AddNewsType;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AddNewsTypeTest extends TypeTestCase
{
    public function testWithGoodData()
    {
        $form = $this->factory->create(AddNewsType::class);

        $form->submit([
            'title'=>'nouveaux-nés',
            'author'=>'admin',
            'image'=>new UploadedFile('public/images/accueil1.jpg', 'photo.jpg', 'image/jpeg', 123),
            'content'=>'les oeufs ont éclos'
        ]);

        static::assertTrue(
            $form->isSubmitted()
        );

        static::assertInstanceOf(NewNewsDTO::class,
            $form->getData()
        );

        static::assertTrue(
            $form->isValid()
        );
    }
}