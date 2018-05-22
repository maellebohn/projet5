<?php

declare(strict_types=1);

namespace App\DataFixtures\ORM;

use App\Domain\Models\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UsersFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new Users('maelle', 'bohn', 'coco', 'bohnmaelle@gmail.com', 'coco');

        $manager->persist($user);
        $manager->flush();
    }
}