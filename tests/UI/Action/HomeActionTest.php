<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use App\UI\Action\HomeAction;
use App\UI\Action\Interfaces\HomeActionInterface;
use App\UI\Responder\HomeResponder;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class HomeActionTest extends KernelTestCase
{
    public function testHomeView()
    {
        $homeAction = new HomeAction();

        $responder = new HomeResponder(
            $this->createMock(Environment::class)
        );

        static::assertInstanceOf(
            Response::class,
            $homeAction($responder)
        );
    }

}
