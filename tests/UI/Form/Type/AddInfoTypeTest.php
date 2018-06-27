<?php

namespace App\Tests\UI\Form\Type;

use App\Domain\DTO\NewInfoDTO;
use App\UI\Form\Type\AddInfoType;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AddInfoTypeTest extends TypeTestCase
{
    public function testWithGoodData()
    {
        $form = $this->factory->create(AddInfoType::class);

        $form->submit([
            'title'=>'alimentation',
            'author'=>'toto',
            'image'=>new UploadedFile('public/images/accueil1.jpg', 'photo.jpg', 'image/jpeg', 123),
            'category'=>'education',
            'content'=>'bien nourrir ses perroquets'
        ]);

        static::assertTrue(
            $form->isSubmitted()
        );

        static::assertInstanceOf(NewInfoDTO::class,
            $form->getData()
        );

        static::assertTrue(
            $form->isValid()
        );
    }
}