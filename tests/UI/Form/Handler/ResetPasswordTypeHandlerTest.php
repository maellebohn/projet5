<?php

declare(strict_types=1);

namespace App\Tests\UI\Form\Handler;

use App\Domain\DTO\UserNewPasswordDTO;
use App\Domain\Models\Interfaces\UsersInterface;
use App\Repository\Interfaces\UsersRepositoryInterface;
use App\UI\Form\Handler\ResetPasswordTypeHandler;
use App\UI\Form\Handler\Interfaces\ResetPasswordTypeHandlerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class ResetPasswordTypeHandlerTest extends TestCase
{
    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var UsersRepositoryInterface
     */
    private $usersRepository;

    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;

    /**
     *{@inheritdoc}
     */
    protected function setUp ()
    {
        $this->session = new Session(new MockArraySessionStorage());
        $this->usersRepository = $this->createMock(UsersRepositoryInterface::class);
        $this->encoderFactory = $this->createMock(EncoderFactoryInterface::class);
        $this->encoderFactory->method('getEncoder')->willReturn(new BCryptPasswordEncoder(13));
    }

    public function testConstruct ()
    {
        $resetPasswordTypeHandler = new ResetPasswordTypeHandler(
            $this->usersRepository,
            $this->session,
            $this->encoderFactory
        );

        static::assertInstanceOf(
            ResetPasswordTypeHandlerInterface::class,
            $resetPasswordTypeHandler
        );
    }

    public function testWrongHandlingProcess ()
    {
        $formInterfaceMock = $this->createMock(FormInterface::class);
        $userInterfaceMock = $this->createMock (UsersInterface::class);

        $resetPasswordTypeHandler = new ResetPasswordTypeHandler(
            $this->usersRepository,
            $this->session,
            $this->encoderFactory
        );

        $formInterfaceMock->method('isValid')->willReturn(false);
        $formInterfaceMock->method('isSubmitted')->willReturn(false);

        static::assertFalse(
            $resetPasswordTypeHandler->handle($formInterfaceMock, $userInterfaceMock)
        );
    }

    public function testRightHandlingProcess ()
    {
        $formInterfaceMock = $this->createMock(FormInterface::class);
        $userInterfaceMock = $this->createMock (UsersInterface::class);

        $userNewPasswordDTOMock = new UserNewPasswordDTO(
            'toto'
        );

        $resetPasswordTypeHandler = new ResetPasswordTypeHandler(
            $this->usersRepository,
            $this->session,
            $this->encoderFactory
        );

        $formInterfaceMock->method('isValid')->willReturn(true);
        $formInterfaceMock->method('isSubmitted')->willReturn(true);
        $formInterfaceMock->method('getData')->willReturn($userNewPasswordDTOMock);

        static::assertTrue(
            $resetPasswordTypeHandler->handle($formInterfaceMock, $userInterfaceMock)
        );
    }
}