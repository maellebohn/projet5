<?php

namespace App\Tests\UI\Action;

use App\UI\Action\HomeAction;
use App\UI\Action\Interfaces\HomeActionInterface;
use App\UI\Responder\HomeResponder;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class HomeActionTest extends KernelTestCase
{
    public function testHomeAffichage()
    {
        $responder = new HomeResponder(
            $this->createMock(Environment::class)
        );

        $homeAction = new HomeAction();

        static::assertInstanceOf(
            Response::class,
            $homeAction($responder)
        );
    }

}
