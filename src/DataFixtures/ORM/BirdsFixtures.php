<?php

declare(strict_types=1);

namespace App\DataFixtures\ORM;

use App\Domain\Models\Birds;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class BirdsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $bird = new Birds('coco',1530741600, 'mâle', 200);

        $manager->persist($bird);
        $manager->flush();
    }
}