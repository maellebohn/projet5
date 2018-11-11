<?php

declare(strict_types=1);

namespace App\Tests\Domain\Models;

use App\Domain\Models\Infos;
use App\Domain\Models\Interfaces\UsersInterface;
use PHPUnit\Framework\TestCase;

class InfosTest extends TestCase
{
    /**
     * @var UsersInterface
     */
    private $user;

    protected function setUp ()
    {
        $this->user = $this->createMock(UsersInterface::class);
    }

    public function testConstructor()
    {
        $info = new Infos(
            'graines, fruits et légumes',
            'alimentation',
            $this->user,
            'education',
            'oiseau'
        );

        static::assertSame('graines, fruits et légumes', $info->getContent());

        static::assertSame('alimentation', $info->getTitle());

        static::assertSame('oiseau', $info->getImage());

        static::assertInstanceOf(UsersInterface::class, $info->getAuthor());

        static::assertSame('education', $info->getCategory());
    }
}