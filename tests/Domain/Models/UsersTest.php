<?php

declare(strict_types=1);

namespace App\Tests\Domain\Models;

use App\Domain\Models\Users;
use PHPUnit\Framework\TestCase;

class UsersTest extends TestCase
{
    public function testConstructor()
    {
        $user = new Users(
            'maelle',
            'bohn',
            'coco',
            'coco@gmail.com',
            'coco'
        );

        static::assertSame('maelle', $user->getFirstname());

        static::assertSame('bohn', $user->getLastname());

        static::assertSame('coco', $user->getUsername());

        static::assertSame('coco@gmail.com', $user->getEmail());

        static::assertSame('coco', $user->getPassword());
    }
}