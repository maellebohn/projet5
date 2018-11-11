<?php

declare(strict_types=1);

namespace App\DataFixtures\ORM;

use App\Domain\Models\Birds;
use App\Domain\Models\Infos;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class InfosFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $info = new Infos('coco','comment nourrir son perroquet', 'alimentation');

        $manager->persist($info);
        $manager->flush();
    }
}