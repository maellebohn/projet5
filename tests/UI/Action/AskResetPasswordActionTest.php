<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use App\UI\Action\AskResetPasswordAction;
use App\UI\Action\Interfaces\AskResetPasswordActionInterface;
use App\UI\Form\Handler\Interfaces\AskResetPasswordTypeHandlerInterface;
use App\UI\Responder\AskResetPasswordResponder;
use Blackfire\Bridge\PhpUnit\TestCaseTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class AskResetPasswordActionTest extends WebTestCase
{
    use TestCaseTrait;

    /**
     * @var AskResetPasswordTypeHandlerInterface
     */
    private $askResetPasswordTypeHandler;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var UrlGeneratorInterface
     */
    private $router;

    /**
     *{@inheritdoc}
     */
    public function setUp ()
    {
        $this->formFactory = $this->createMock(FormFactoryInterface::class);
        $this->askResetPasswordTypeHandler = $this->createMock(AskResetPasswordTypeHandlerInterface::class);
        $this->router = $this->createMock(UrlGeneratorInterface::class);
        $this->router->method('generate')->willReturn('/login');
    }

    public function testConstruct()
    {
        $formInterfaceMock = $this->createMock(FormInterface::class);
        $formInterfaceMock->method('handleRequest')->willReturnSelf();
        $this->formFactory->method('create')->willReturn($formInterfaceMock);

        $askResetPasswordAction = new AskResetPasswordAction(
            $this->formFactory,
            $this->askResetPasswordTypeHandler
        );

        static::assertInstanceOf(
            AskResetPasswordActionInterface::class,
            $askResetPasswordAction
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

        $askResetPasswordAction = new AskResetPasswordAction(
            $this->formFactory,
            $this->askResetPasswordTypeHandler
        );

        $this->askResetPasswordTypeHandler->method('handle')->willReturn(false);

        $responder = new AskResetPasswordResponder(
            $this->createMock(Environment::class),
            $this->router
        );

        $requestMock = $this->createMock(Request::class);

        $probe = static::$blackfire->createProbe();

        $askResetPasswordAction($requestMock, $responder);

        static::$blackfire->endProbe($probe);


        static::assertInstanceOf(
            Response::class,
            $askResetPasswordAction($requestMock, $responder)
        );
    }

    public function testGoodFormHandling()
    {
        $formInterfaceMock = $this->createMock(FormInterface::class);
        $formInterfaceMock->method('handleRequest')->willReturnSelf();
        $this->formFactory->method('create')->willReturn($formInterfaceMock);

        $askResetPasswordAction = new AskResetPasswordAction(
            $this->formFactory,
            $this->askResetPasswordTypeHandler
        );

        $this->askResetPasswordTypeHandler->method('handle')->willReturn(true);

        $responder = new AskResetPasswordResponder(
            $this->createMock(Environment::class),
            $this->router
        );

        $requestMock = $this->createMock(Request::class);

        static::assertInstanceOf(
            RedirectResponse::class,
            $askResetPasswordAction($requestMock, $responder)
        );
    }
}