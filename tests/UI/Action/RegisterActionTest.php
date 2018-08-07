<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use App\UI\Action\RegisterAction;
use App\UI\Action\Interfaces\RegisterActionInterface;
use App\UI\Form\Handler\Interfaces\RegisterTypeHandlerInterface;
use App\UI\Responder\RegisterResponder;
use Blackfire\Bridge\PhpUnit\TestCaseTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class RegisterActionTest extends WebTestCase
{
    use TestCaseTrait;

    /**
     * @var RegisterTypeHandlerInterface
     */
    private $registerTypeHandler;

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
        $this->registerTypeHandler = $this->createMock(RegisterTypeHandlerInterface::class);
        $this->router = $this->createMock(UrlGeneratorInterface::class);
        $this->router->method('generate')->willReturn('/register');

    }

    public function testConstruct()
    {
        $contactAction = new RegisterAction(
            $this->formFactory,
            $this->registerTypeHandler
        );

        static::assertInstanceOf(
            RegisterActionInterface::class,
            $contactAction
        );
    }

    /**
     * @group Blackfire
     */
    public function testWrongFormHandling()
    {
        $registerAction = new RegisterAction(
            $this->formFactory,
            $this->registerTypeHandler
        );

        $this->registerTypeHandler->method('handle')->willReturn(false);
        $responder = new RegisterResponder(
            $this->createMock(Environment::class),
            $this->router
        );

        $request = Request::create(
            '/register',
            'POST'
        );

        $probe = static::$blackfire->createProbe();

        $registerAction($request, $responder);

        static::$blackfire->endProbe($probe);


        static::assertInstanceOf(
            Response::class,
            $registerAction($request, $responder)
        );
    }

    public function testGoodFormHandling()
    {
        $registerAction = new RegisterAction(
            $this->formFactory,
            $this->registerTypeHandler
        );

        $this->registerTypeHandler->method('handle')->willReturn(true);
        $responder = new RegisterResponder(
            $this->createMock(Environment::class),
            $this->router
        );

        $request = Request::create(
            '/register',
            'POST'
        );

        static::assertInstanceOf(
            RedirectResponse::class,
            $registerAction($request, $responder)
        );
    }
}