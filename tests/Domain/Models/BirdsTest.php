<?php

namespace App\Tests\Domain\Models;

use App\Domain\Models\Birds;
use PHPUnit\Framework\TestCase;

class BirdsTest extends TestCase
{
    public function testConstructor()
    {
        $bird = new Birds('inoue','2018-02-05','femelle','200');

        static::assertSame(
            'inoue',
            $bird->getBird()
        );

        static::assertSame(
            '2018-02-05',
            $bird->getBird()
        );

        static::assertSame(
            'femelle',
            $bird->getBird()
        );

        static::assertSame(
            '200',
            $bird->getBird()
        );
    }
}
