<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use App\Repository\Interfaces\NewsRepositoryInterface;
use App\UI\Action\DeleteNewsAction;
use App\UI\Action\Interfaces\DeleteNewsActionInterface;
use App\UI\Responder\DeleteNewsResponder;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class DeleteNewsActionTest extends WebTestCase
{
    /**
     * @var NewsRepositoryInterface
     */
    private $newsRepository;

    /**
     * @var UrlGeneratorInterface
     */
    private $router;

    /**
     *{@inheritdoc}
     */
    protected function setUp ()
    {
        $this->newsRepository = $this->createMock(NewsRepositoryInterface::class);
        $this->newsRepository->method('deleteById');
        $this->router = $this->createMock(UrlGeneratorInterface::class);
        $this->router->method('generate')->willReturn('/admin');
    }

    public function testConstruct()
    {
        $deleteNewsAction = new DeleteNewsAction($this->newsRepository);

        static::assertInstanceOf(
            DeleteNewsActionInterface::class,
            $deleteNewsAction
        );
    }

    public function testAdminAfterDeleteView()
    {
        $deleteNewsAction = new DeleteNewsAction($this->newsRepository);

        $responder = new DeleteNewsResponder(
            $this->createMock(Environment::class),
            $this->router
        );

        $requestMock = $this->createMock(Request::class);

        static::assertInstanceOf(
            Response::class,
            $deleteNewsAction($requestMock, $responder)
        );
    }
}