<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use App\UI\Action\ShowCategoryInfosAction;
use App\UI\Action\Interfaces\ShowCategoryInfosActionInterface;
use App\UI\Responder\ShowCategoryInfosResponder;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ShowCategoryInfosActionTest extends KernelTestCase
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
