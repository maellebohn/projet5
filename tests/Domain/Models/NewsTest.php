<?php

declare(strict_types=1);

namespace App\Tests\Domain\Models;

use App\Domain\Models\News;
use PHPUnit\Framework\TestCase;

class NewsTest extends TestCase
{
    public function testConstructor()
    {
        $new = new News(
            'les oeufs ont éclos',
            'nouveaux-nés',
            3,
            'admin'
        );

        static::assertSame('les oeufs ont éclos', $new->getContent());

        static::assertSame('nouveaux-nés', $new->getTitle());

        static::assertSame(3, $new->getImage());

        static::assertSame('admin', $new->getAuthor());
    }
}