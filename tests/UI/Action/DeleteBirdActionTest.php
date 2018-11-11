<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use App\Repository\Interfaces\BirdsRepositoryInterface;
use App\UI\Action\DeleteBirdAction;
use App\UI\Action\Interfaces\DeleteBirdActionInterface;
use App\UI\Responder\DeleteBirdResponder;
use App\UI\Responder\Interfaces\DeleteBirdResponderInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class DeleteBirdActionTest extends WebTestCase
{
    /**
     * @var BirdsRepositoryInterface
     */
    private $birdsRepository;

    /**
     * @var UrlGeneratorInterface
     */
    private $router;

    /**
     *{@inheritdoc}
     */
    protected function setUp ()
    {
        $this->birdsRepository = $this->createMock(BirdsRepositoryInterface::class);
        $this->birdsRepository->method('deleteById');
        $this->router = $this->createMock(UrlGeneratorInterface::class);
        $this->router->method('generate')->willReturn('/admin');
    }

    public function testConstruct()
    {
        $deleteBirdAction = new DeleteBirdAction($this->birdsRepository);

        static::assertInstanceOf(
            DeleteBirdActionInterface::class,
            $deleteBirdAction
        );
    }

    public function testAdminAfterDeleteView()
    {
        $deleteBirdAction = new DeleteBirdAction($this->birdsRepository);

        $responder = new DeleteBirdResponder(
            $this->createMock(Environment::class),
            $this->router
        );

        $request = Request::create('/deletebird/1e1796b3-8e1a-452e-85d5-2b0248ed3cde', 'GET');
        $requestMock = $request->duplicate([],[],['id' => '1e1796b3-8e1a-452e-85d5-2b0248ed3cde']);

        static::assertInstanceOf(
            Response::class,
            $deleteBirdAction($requestMock, $responder)
        );
    }
}