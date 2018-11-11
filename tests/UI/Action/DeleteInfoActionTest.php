<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use App\Repository\Interfaces\InfosRepositoryInterface;
use App\UI\Action\DeleteInfoAction;
use App\UI\Action\Interfaces\DeleteInfoActionInterface;
use App\UI\Responder\DeleteInfoResponder;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class DeleteInfoActionTest extends WebTestCase
{
    /**
     * @var InfosRepositoryInterface
     */
    private $infosRepository;

    /**
     * @var UrlGeneratorInterface
     */
    private $router;

    /**
     *{@inheritdoc}
     */
    protected function setUp ()
    {
        $this->infosRepository = $this->createMock(InfosRepositoryInterface::class);
        $this->infosRepository->method('deleteById');
        $this->router = $this->createMock(UrlGeneratorInterface::class);
        $this->router->method('generate')->willReturn('/admin');
    }

    public function testConstruct()
    {
        $deleteInfoAction = new DeleteInfoAction($this->infosRepository);

        static::assertInstanceOf(
            DeleteInfoActionInterface::class,
            $deleteInfoAction
        );
    }

    public function testAdminAfterDeleteView()
    {
        $deleteInfoAction = new DeleteInfoAction($this->infosRepository);

        $responder = new DeleteInfoResponder(
            $this->createMock(Environment::class),
            $this->router
        );

        $request = Request::create('/deleteinfo/1e1796b3-8e1a-452e-85d5-2b0248ed3cde', 'GET');
        $requestMock = $request->duplicate([],[],['id' => '1e1796b3-8e1a-452e-85d5-2b0248ed3cde']);

        static::assertInstanceOf(
            Response::class,
            $deleteInfoAction($requestMock, $responder)
        );
    }
}