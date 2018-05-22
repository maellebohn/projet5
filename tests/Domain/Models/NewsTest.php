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
            'oiseau',
            'admin'
        );

        static::assertSame('les oeufs ont éclos', $new->getContent());

        static::assertSame('nouveaux-nés', $new->getTitle());

        static::assertSame('oiseau', $new->getImage());

        static::assertSame('admin', $new->getAuthor());
    }
}