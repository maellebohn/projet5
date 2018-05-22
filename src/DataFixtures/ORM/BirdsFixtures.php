<?php

declare(strict_types=1);

namespace App\DataFixtures\ORM;

use App\Domain\Models\Birds;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use DateTime;

class BirdsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new Birds('coco','null', 'mâle', 200);

        $manager->persist($user);
        $manager->flush();
    }
}