<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use App\Domain\Models\Interfaces\NewsInterface;
use App\Repository\Interfaces\NewsRepositoryInterface;
use App\UI\Action\UpdateNewsAction;
use App\UI\Action\Interfaces\UpdateNewsActionInterface;
use App\UI\Form\Handler\Interfaces\UpdateNewsTypeHandlerInterface;
use App\UI\Responder\UpdateNewsResponder;
use Blackfire\Bridge\PhpUnit\TestCaseTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class UpdateNewsActionTest extends WebTestCase
{
    use TestCaseTrait;

    /**
     * @var UpdateNewsTypeHandlerInterface
     */
    private $updateNewsTypeHandler;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var UrlGeneratorInterface
     */
    private $router;

    /**
     * @var NewsRepositoryInterface
     */
    private $newsRepository;

    /**
     * @var NewsInterface
     */
    private $news;

    /**
     *{@inheritdoc}
     */
    protected function setUp ()
    {
        $this->formFactory = $this->createMock(FormFactoryInterface::class);
        $this->updateNewsTypeHandler = $this->createMock(UpdateNewsTypeHandlerInterface::class);
        $this->router = $this->createMock(UrlGeneratorInterface::class);
        $this->router->method('generate')->willReturn('/admin');
        $this->newsRepository = $this->createMock(NewsRepositoryInterface::class);
        $this->news = $this->createMock(NewsInterface::class);
        $this->newsRepository->method('findOneBy')->willReturn($this->news);
        $this->news->method('getTitle')->willReturn('alimentation');
        $this->news->method('getImage')->willReturn(null);
        $this->news->method('getContent')->willReturn('bien nourrir ses perroquets');
    }

    public function testConstruct()
    {
        $updateNewsAction = new UpdateNewsAction(
            $this->newsRepository,
            $this->formFactory,
            $this->updateNewsTypeHandler
        );

        static::assertInstanceOf(
            UpdateNewsActionInterface::class,
            $updateNewsAction
        );
    }

    /**
     * @group Blackfire
     */
    public function testWrongFormHandling()
    {
        $formInterfaceMock = $this->createMock(FormInterface::class);
        $formInterfaceMock->method('handleRequest')->willReturnSelf();
        $this->formFactory->method('create')->willReturn($formInterfaceMock);

        $updateNewsAction = new UpdateNewsAction(
            $this->newsRepository,
            $this->formFactory,
            $this->updateNewsTypeHandler
        );

        $this->updateNewsTypeHandler->method('handle')->willReturn(false);

        $responder = new UpdateNewsResponder(
            $this->createMock(Environment::class),
            $this->router
        );

        $request = Request::create('/updatenews/1e1796b3-8e1a-452e-85d5-2b0248ed3cde', 'GET');
        $requestMock = $request->duplicate([],[],['id' => '1e1796b3-8e1a-452e-85d5-2b0248ed3cde']);

        $probe = static::$blackfire->createProbe();

        $updateNewsAction($requestMock, $responder);

        static::$blackfire->endProbe($probe);


        static::assertInstanceOf(
            Response::class,
            $updateNewsAction($requestMock, $responder)
        );
    }

    public function testGoodFormHandling()
    {
        $formInterfaceMock = $this->createMock(FormInterface::class);
        $formInterfaceMock->method('handleRequest')->willReturnSelf();
        $this->formFactory->method('create')->willReturn($formInterfaceMock);

        $updateNewsAction = new UpdateNewsAction(
            $this->newsRepository,
            $this->formFactory,
            $this->updateNewsTypeHandler
        );

        $this->updateNewsTypeHandler->method('handle')->willReturn(true);

        $responder = new UpdateNewsResponder(
            $this->createMock(Environment::class),
            $this->router
        );

        $request = Request::create('/updatenews/1e1796b3-8e1a-452e-85d5-2b0248ed3cde', 'GET');
        $requestMock = $request->duplicate([],[],['id' => '1e1796b3-8e1a-452e-85d5-2b0248ed3cde']);

        static::assertInstanceOf(
            RedirectResponse::class,
            $updateNewsAction($requestMock, $responder)
        );
    }
}