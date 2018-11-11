<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use App\Domain\Models\Interfaces\UsersInterface;
use App\Repository\Interfaces\UsersRepositoryInterface;
use App\UI\Action\Interfaces\ResetPasswordActionInterface;
use App\UI\Action\ResetPasswordAction;
use App\UI\Form\Handler\Interfaces\ResetPasswordTypeHandlerInterface;
use App\UI\Responder\ResetPasswordResponder;
use Blackfire\Bridge\PhpUnit\TestCaseTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class ResetPasswordActionTest extends WebTestCase
{
    use TestCaseTrait;

    /**
     * @var ResetPasswordTypeHandlerInterface
     */
    private $resetPasswordTypeHandler;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var UrlGeneratorInterface
     */
    private $router;

    /**
     * @var UsersRepositoryInterface
     */
    private $usersRepository;

    /**
     * @var UsersInterface
     */
    private $user;

    /**
     *{@inheritdoc}
     */
    protected function setUp ()
    {
        $this->formFactory = $this->createMock(FormFactoryInterface::class);
        $this->resetPasswordTypeHandler = $this->createMock(ResetPasswordTypeHandlerInterface::class);
        $this->router = $this->createMock(UrlGeneratorInterface::class);
        $this->router->method('generate')->willReturn('/login');
        $this->usersRepository = $this->createMock(UsersRepositoryInterface::class);
        $this->user = $this->createMock(UsersInterface::class);
        $this->usersRepository->method('getUserByResetPasswordToken')->willReturn($this->user);
    }

    public function testConstruct()
    {
        $resetPasswordAction = new ResetPasswordAction(
            $this->formFactory,
            $this->resetPasswordTypeHandler,
            $this->usersRepository
        );

        static::assertInstanceOf(
            ResetPasswordActionInterface::class,
            $resetPasswordAction
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

        $resetPasswordAction = new ResetPasswordAction(
            $this->formFactory,
            $this->resetPasswordTypeHandler,
            $this->usersRepository
        );

        $this->resetPasswordTypeHandler->method('handle')->willReturn(false);

        $responder = new ResetPasswordResponder(
            $this->createMock(Environment::class),
            $this->router
        );

        $request = Request::create('/resetpassword/ghjkizzkfejzejfizf', 'GET');
        $requestMock = $request->duplicate([],[],['token' => 'ghjkizzkfejzejfizf']);

        $probe = static::$blackfire->createProbe();

        $resetPasswordAction($requestMock, $responder);

        static::$blackfire->endProbe($probe);


        static::assertInstanceOf(
            Response::class,
            $resetPasswordAction($requestMock, $responder)
        );
    }

    public function testGoodFormHandling()
    {
        $formInterfaceMock = $this->createMock(FormInterface::class);
        $formInterfaceMock->method('handleRequest')->willReturnSelf();
        $this->formFactory->method('create')->willReturn($formInterfaceMock);

        $resetPasswordAction = new ResetPasswordAction(
            $this->formFactory,
            $this->resetPasswordTypeHandler,
            $this->usersRepository
        );

        $this->resetPasswordTypeHandler->method('handle')->willReturn(true);

        $responder = new ResetPasswordResponder(
            $this->createMock(Environment::class),
            $this->router
        );

        $request = Request::create('/resetpassword/ghjkizzkfejzejfizf', 'GET');
        $requestMock = $request->duplicate([],[],['token' => 'ghjkizzkfejzejfizf']);

        static::assertInstanceOf(
            RedirectResponse::class,
            $resetPasswordAction($requestMock, $responder)
        );
    }
}