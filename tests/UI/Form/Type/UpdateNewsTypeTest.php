<?php

namespace App\Tests\UI\Form\Type;

use App\Domain\DTO\UpdateNewsDTO;
use App\UI\Form\Type\UpdateNewsType;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UpdateNewsTypeTest extends TypeTestCase
{
    public function testWithGoodData()
    {
        $form = $this->factory->create(UpdateNewsType::class);

        $form->submit([
            'title' => 'nouveaux-nés',
            'author' => 'admin',
            'image' => new UploadedFile('public/images/accueil1.jpg', 'photo.jpg', 'image/jpeg', 123),
            'content' => 'les oeufs ont éclos'
        ]);

        static::assertTrue(
            $form->isSubmitted()
        );

        static::assertInstanceOf(UpdateNewsDTO::class,
            $form->getData()
        );

        static::assertTrue(
            $form->isValid()
        );
    }
}