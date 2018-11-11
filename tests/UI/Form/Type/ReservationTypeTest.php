<?php

namespace App\Tests\UI\Form\Type;

use App\Domain\DTO\NewReservationFormSubmittedDTO;
use App\UI\Form\Type\ReservationType;
use Symfony\Component\Form\Test\TypeTestCase;

class ReservationTypeTest extends TypeTestCase
{
    public function testWithGoodData()
    {
        $form = $this->factory->create(ReservationType::class);

        $form->submit([
            'name' => 'toto',
            'email' => 'toto@gmail.com',
            'message' => 'hello',
            'id' => '1e1796b3-8e1a-452e-85d5-2b0248ed3cde'
        ]);

        static::assertTrue(
            $form->isSubmitted()
        );

        static::assertInstanceOf(NewReservationFormSubmittedDTO::class,
            $form->getData()
        );

        static::assertTrue(
            $form->isValid()
        );
    }
}