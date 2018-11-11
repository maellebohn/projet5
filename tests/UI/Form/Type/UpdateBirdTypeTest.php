<?php

namespace App\Tests\UI\Form\Type;

use App\Domain\DTO\UpdateBirdDTO;
use App\UI\Form\Type\UpdateBirdType;
use Symfony\Component\Form\Test\TypeTestCase;

class UpdateBirdTypeTest extends TypeTestCase
{
    public function testWithGoodData()
    {
        $form = $this->factory->create(UpdateBirdType::class);

        $form->submit([
            'name' => 'inoue',
            'birthdate' => ['year' => '2018', 'month' => '3', 'day' => '28' ],
            'price' => 200,
            'description' => 'femelle'
        ]);

        static::assertTrue(
            $form->isSubmitted()
        );

        static::assertInstanceOf(UpdateBirdDTO::class,
            $form->getData()
        );

        static::assertTrue(
            $form->isValid()
        );
    }
}