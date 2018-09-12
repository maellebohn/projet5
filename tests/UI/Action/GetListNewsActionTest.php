<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use App\Repository\Interfaces\NewsRepositoryInterface;
use App\UI\Action\GetListNewsAction;
use App\UI\Action\Interfaces\GetListNewsActionInterface;
use App\UI\Responder\GetListNewsResponder;
use App\UI\Responder\Interfaces\GetListNewsResponderInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class GetListNewsActionTest extends WebTestCase
{
    /**
     * @var NewsRepositoryInterface
     */
    private $newsRepository;

    /**
     *{@inheritdoc}
     */
    protected function setUp ()
    {
        $this->newsRepository = $this->createMock(NewsRepositoryInterface::class);
        $this->newsRepository->method('findAll')->willReturn([]);
    }

    public function testConstruct()
    {
        $getListNewsAction = new GetListNewsAction($this->newsRepository);

        static::assertInstanceOf(
            GetListNewsActionInterface::class,
            $getListNewsAction
        );
    }

    public function testListNewsPageView()
    {
        $getListNewsAction = new GetListNewsAction($this->newsRepository);

        $responder = new GetListNewsResponder($this->createMock(Environment::class));

        static::assertInstanceOf(
            Response::class,
            $getListNewsAction($responder)
        );
    }
}