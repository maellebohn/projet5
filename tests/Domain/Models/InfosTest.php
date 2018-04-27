<?php

declare(strict_types=1);

namespace App\Tests\Domain\Models;

use App\Domain\Models\Infos;
use PHPUnit\Framework\TestCase;

class InfosTest extends TestCase
{
    public function testConstructor()
    {
        $info = new Infos('graines, fruits et légumes','alimentation',3,'admin');

        static::assertSame(
            'graines, fruits et légumes',
            $info->getContent()
        );

        static::assertSame(
            'alimentation',
            $info->getTitle()
        );

        static::assertSame(
            3,
            $info->getImage()
        );

        static::assertSame(
            'admin',
            $info->getAuthor()
        );
    }
}