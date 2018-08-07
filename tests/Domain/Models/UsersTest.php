<?php

declare(strict_types=1);

namespace App\Tests\Domain\Models;

use App\Domain\Models\Users;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

class UsersTest extends TestCase
{
    /**
     * @var PasswordEncoderInterface
     */
    private $passwordEncoder;

    public function setUp ()
    {
        $this->passwordEncoder = $this->createMock(PasswordEncoderInterface::class);
    }

    public function testConstructor()
    {//$encoder = closure::from callable
        $user = new Users(
            'maelle',
            'bohn',
            'coco',
            'coco@gmail.com',
            'coco',
            $encoder
        );

        static::assertSame('maelle', $user->getFirstname());

        static::assertSame('bohn', $user->getLastname());

        static::assertSame('coco', $user->getUsername());

        static::assertSame('coco@gmail.com', $user->getEmail());

        static::assertSame('coco', $user->getPassword());
    }
}