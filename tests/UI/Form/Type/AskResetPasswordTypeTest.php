<?php

namespace App\Tests\UI\Form\Type;

use App\Domain\DTO\UserResetPasswordDTO;
use App\UI\Form\Type\AskResetPasswordType;
use Symfony\Component\Form\Test\TypeTestCase;

class AskResetPasswordTypeTest extends TypeTestCase
{
    public function testWithGoodData()
    {
        $form = $this->factory->create(AskResetPasswordType::class);

        $form->submit([
            'username' => 'toto',
            'email' => 'toto@gmail.com',
        ]);

        static::assertTrue(
            $form->isSubmitted()
        );

        static::assertInstanceOf(UserResetPasswordDTO::class,
            $form->getData()
        );

        static::assertTrue(
            $form->isValid()
        );
    }
}