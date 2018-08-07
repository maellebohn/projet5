<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use App\UI\Action\HomeAction;
use App\UI\Responder\HomeResponder;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class HomeActionTest extends WebTestCase
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
