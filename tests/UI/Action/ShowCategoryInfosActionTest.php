<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use App\UI\Action\ShowCategoryInfosAction;
use App\UI\Responder\ShowCategoryInfosResponder;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ShowCategoryInfosActionTest extends WebTestCase
{
    public function testShowCategoryInfosView()
    {
        $showCategoryInfosAction = new ShowCategoryInfosAction();

        $responder = new ShowCategoryInfosResponder(
            $this->createMock(Environment::class)
        );

        static::assertInstanceOf(
            Response::class,
            $showCategoryInfosAction($responder)
        );
    }

}
