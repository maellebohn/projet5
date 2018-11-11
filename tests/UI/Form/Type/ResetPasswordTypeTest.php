<?php

namespace App\Tests\UI\Form\Type;

use App\Domain\DTO\UserNewPasswordDTO;
use App\UI\Form\Type\ResetPasswordType;
use Symfony\Component\Form\Test\TypeTestCase;

class ResetPasswordTypeTest extends TypeTestCase
{
    public function testWithGoodData()
    {
        $form = $this->factory->create(ResetPasswordType::class);

        $form->submit([
            'password' => ['first' => 'coco', 'second' => 'coco']
        ]);

        static::assertTrue(
            $form->isSubmitted()
        );

        static::assertInstanceOf(UserNewPasswordDTO::class,
            $form->getData()
        );

        static::assertTrue(
            $form->isValid()
        );
    }
}