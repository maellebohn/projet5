<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use App\Repository\Interfaces\NewsRepositoryInterface;
use App\UI\Action\GetNewsAction;
use App\UI\Action\Interfaces\GetNewsActionInterface;
use App\UI\Responder\GetNewsResponder;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;

class GetNewsActionTest extends WebTestCase
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
        $this->newsRepository->method('findOneBy');
    }

    public function testConstruct()
    {
        $getNewsAction = new GetNewsAction($this->newsRepository);

        static::assertInstanceOf(
            GetNewsActionInterface::class,
            $getNewsAction
        );
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function testGetNewsView()
    {
        $getNewsAction = new GetNewsAction($this->newsRepository);

        $responder = new GetNewsResponder($this->createMock(Environment::class));

        $request = Request::create('/news/1e1796b3-8e1a-452e-85d5-2b0248ed3cde', 'GET');
        $requestMock = $request->duplicate();

        static::assertInstanceOf(
            Response::class,
            $getNewsAction($requestMock, $responder)
        );
    }
}