<?php

declare(strict_types=1);

namespace App\Tests\Domain\Models;

use App\Domain\Models\News;
use PHPUnit\Framework\TestCase;

class NewsTest extends TestCase
{
    public function testConstructor()
    {
        $news = new News(
            'les oeufs ont éclos',
            'nouveaux-nés',
            'admin',
            'oiseau'
        );

        static::assertSame('les oeufs ont éclos', $news->getContent());

        static::assertSame('nouveaux-nés', $news->getTitle());

        static::assertSame('admin', $news->getAuthor());

        static::assertSame('oiseau', $news->getImage());
    }
}