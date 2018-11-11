<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use App\UI\Action\ShowLegalNoticeAction;
use App\UI\Responder\ShowLegalNoticeResponder;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ShowLegalNoticeActionTest extends WebTestCase
{
    public function testShowLegalNoticeView()
    {
        $showLegalNoticeAction = new ShowLegalNoticeAction();

        $responder = new ShowLegalNoticeResponder(
            $this->createMock(Environment::class)
        );

        static::assertInstanceOf(
            Response::class,
            $showLegalNoticeAction($responder)
        );
    }

}
