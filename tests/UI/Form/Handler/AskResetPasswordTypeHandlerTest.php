<?php

declare(strict_types=1);

namespace App\Tests\UI\Form\Handler;

use App\Domain\DTO\UserResetPasswordDTO;
use App\Helper\Interfaces\TokenGeneratorHelperInterface;
use App\Repository\Interfaces\UsersRepositoryInterface;
use App\UI\Form\Handler\AskResetPasswordTypeHandler;
use App\UI\Form\Handler\Interfaces\AskResetPasswordTypeHandlerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

class AskResetPasswordTypeHandlerTest extends KernelTestCase
{
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var UsersRepositoryInterface
     */
    private $usersRepository;

    /**
     * @var TokenGeneratorHelperInterface
     */
    private $tokenGeneratorHelper;

    /**
     *{@inheritdoc}
     */
    protected function setUp ()
    {
        static::bootKernel();

        $this->eventDispatcher = static::$kernel->getContainer()->get('event_dispatcher');
        $this->session = new Session(new MockArraySessionStorage());
        $this->usersRepository = $this->createMock(UsersRepositoryInterface::class);
        $this->tokenGeneratorHelper = $this->createMock(TokenGeneratorHelperInterface::class);
    }

    public function testConstruct ()
    {
        $askResetPasswordTypeHandler = new AskResetPasswordTypeHandler(
            $this->usersRepository,
            $this->eventDispatcher,
            $this->session,
            $this->tokenGeneratorHelper
        );

        static::assertInstanceOf(
            AskResetPasswordTypeHandlerInterface::class,
            $askResetPasswordTypeHandler
        );
    }

    public function testWrongHandlingProcess ()
    {
        $formInterfaceMock = $this->createMock(FormInterface::class);

        $askResetPasswordTypeHandler = new AskResetPasswordTypeHandler(
            $this->usersRepository,
            $this->eventDispatcher,
            $this->session,
            $this->tokenGeneratorHelper
        );

        $formInterfaceMock->method('isValid')->willReturn(false);
        $formInterfaceMock->method('isSubmitted')->willReturn(false);

        static::assertFalse(
            $askResetPasswordTypeHandler->handle($formInterfaceMock)
        );
    }

    public function testRightHandlingProcess ()
    {
        $formInterfaceMock = $this->createMock(FormInterface::class);

        $userResetPasswordDTOMock = new UserResetPasswordDTO(
            'toto',
            'toto@gmail.com'
        );

        $askResetPasswordTypeHandler = new AskResetPasswordTypeHandler(
            $this->usersRepository,
            $this->eventDispatcher,
            $this->session,
            $this->tokenGeneratorHelper
        );

        $formInterfaceMock->method('isValid')->willReturn(true);
        $formInterfaceMock->method('isSubmitted')->willReturn(true);
        $formInterfaceMock->method('getData')->willReturn($userResetPasswordDTOMock);

        static::assertTrue(
            $askResetPasswordTypeHandler->handle($formInterfaceMock)
        );
    }
}