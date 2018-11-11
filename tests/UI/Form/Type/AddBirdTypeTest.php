<?php

namespace App\Tests\UI\Form\Type;

use App\Domain\DTO\NewBirdDTO;
use App\UI\Form\Type\AddBirdType;
use Symfony\Component\Form\Test\TypeTestCase;

class AddBirdTypeTest extends TypeTestCase
{
    public function testWithGoodData()
    {
        $form = $this->factory->create(AddBirdType::class);

        $form->submit([
            'name' => 'inoue',
            'birthdate' => ['year' => '2018', 'month' => '3', 'day' => '28' ],
            'price' => 200,
            'description' => 'femelle'
        ]);

        static::assertTrue(
            $form->isSubmitted()
        );

        static::assertInstanceOf(NewBirdDTO::class,
            $form->getData()
        );

        static::assertTrue(
            $form->isValid()
        );
    }
}