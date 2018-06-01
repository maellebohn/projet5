<?php

namespace App\Tests\UI\Form\Type;

use App\UI\Form\Type\AddInfoType;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\HttpFoundation\File\File;

class AddInfoTypeTest extends TypeTestCase
{
    public function testWithGoodData()
    {
        $form = $this->factory->create(AddInfoType::class);

        $form->submit([
            'title' => 'alimentation',
            'author' => 'toto',
            'image' => new File(),
            'category' => 'education',
            'content' => 'bien nourrir ses perroquets'
        ]);

        static::assertTrue(
            $form->isSubmitted()
        );

        static::assertSame([
            'title' => 'alimentation',
            'author' => 'toto',
            'image' => new File(),
            'category' => 'education',
            'content' => 'bien nourrir ses perroquets'
            ],
            $form->getData()
        );

        static::assertTrue(
            $form->isValid()
        );
    }
}