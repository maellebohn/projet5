<?php

declare(strict_types=1);

namespace App\Tests\Domain\Models;

use App\Domain\Models\Birds;
use PHPUnit\Framework\TestCase;

class BirdsTest extends TestCase
{
    public function testConstructor()
    {
        $bird = new Birds(
            'inoue',
            '2018-02-05',
            'femelle',
            200
        );

        static::assertSame('inoue', $bird->getName());

        static::assertSame('2018-02-05', $bird->getBirthdate());

        static::assertSame('femelle', $bird->getDescription());

        static::assertSame(200, $bird->getPrice());
    }
}
