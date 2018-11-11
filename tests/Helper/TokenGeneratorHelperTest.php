<?php

namespace App\Tests\Helper;

use App\Helper\Interfaces\TokenGeneratorHelperInterface;
use App\Helper\TokenGeneratorHelper;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TokenGeneratorHelperTest extends WebTestCase
{
    public function testResetPasswordTokenGeneration()
    {
        $tokenGeneratorHelper = new TokenGeneratorHelper();

        static::assertInstanceOf(
            TokenGeneratorHelperInterface::class,
            $tokenGeneratorHelper
        );

        static::assertNotNull(
            $tokenGeneratorHelper->generateResetPasswordToken('Toto', 'toto@gmail.com')
        );

        static::assertTrue(
            10 == strlen(
                $tokenGeneratorHelper->generateResetPasswordToken('Toto', 'toto@gmail.com')
            )
        );
    }
}