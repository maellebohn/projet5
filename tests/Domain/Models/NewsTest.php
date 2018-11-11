<?php

declare(strict_types=1);

namespace App\Tests\Domain\Models;

use App\Domain\Models\News;
use App\Domain\Models\Interfaces\UsersInterface;
use PHPUnit\Framework\TestCase;

class NewsTest extends TestCase
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
        $this->user->method('getUsername')->willReturn('toto');

        $news = new News(
            'les oeufs ont éclos',
            'nouveaux-nés',
            $this->user,
            'oiseau'
        );

        static::assertSame('les oeufs ont éclos', $news->getContent());

        static::assertSame('nouveaux-nés', $news->getTitle());

        static::assertInstanceOf(UsersInterface::class, $news->getAuthor());

        static::assertSame('oiseau', $news->getImage());
    }
}