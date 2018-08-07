<?php

declare(strict_types=1);

namespace App\Tests\UI\Form\Handler;

use App\Domain\DTO\UserRegistrationDTO;
use App\Repository\Interfaces\UsersRepositoryInterface;
use App\UI\Form\Handler\RegisterTypeHandler;
use App\UI\Form\Handler\Interfaces\RegisterTypeHandlerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegisterTypeHandlerTest extends TestCase
{
    /**
     * @var EncoderFactoryInterface
     */
    private $passwordEncoderFactory;

    /**
     * @var UsersRepositoryInterface
     */
    private $usersRepository;
    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     *{@inheritdoc}
     */
    public function setUp ()
    {
        $this->passwordEncoderFactory = $this->createMock(EncoderFactoryInterface::class);
        $this->usersRepository = $this->createMock(UsersRepositoryInterface::class);
        $this->validator = $this->createMock(ValidatorInterface::class);
        $this->session = new Session(new MockArraySessionStorage());

        $this->passwordEncoderFactory->method('getEncoder')->willReturn(new BCryptPasswordEncoder(13));
        $this->validator->method('validate')->willReturn([]);
    }

    public function testConstruct ()
    {
        $registerTypeHandler = new RegisterTypeHandler(
            $this->passwordEncoderFactory,
            $this->usersRepository,
            $this->validator,
            $this->session
        );

        static::assertInstanceOf(
            RegisterTypeHandlerInterface::class,
            $registerTypeHandler
        );
    }

    public function testWrongHandlingProcess ()
    {
        $formInterfaceMock = $this->createMock(FormInterface::class);

        $registerTypeHandler = new RegisterTypeHandler(
            $this->passwordEncoderFactory,
            $this->usersRepository,
            $this->validator,
            $this->session
        );

        $formInterfaceMock->method('isValid')->willReturn(false);
        $formInterfaceMock->method('isSubmitted')->willReturn(false);

        static::assertFalse(
            $registerTypeHandler->handle($formInterfaceMock)
        );
    }

    public function testRightHandlingProcess ()
    {
        $formInterfaceMock = $this->createMock(FormInterface::class);

        $userRegistrationDTOMock = new UserRegistrationDTO(
            'Toto',
            'TotoL',
            'Ie1FDLTOTO',
            'toto@gmail.com',
            'da248z614d2az68d'
        );

        $registerTypeHandler = new RegisterTypeHandler(
            $this->passwordEncoderFactory,
            $this->usersRepository,
            $this->validator,
            $this->session
        );

        $formInterfaceMock->method('isValid')->willReturn(true);
        $formInterfaceMock->method('isSubmitted')->willReturn(true);
        $formInterfaceMock->method('getData')->willReturn($userRegistrationDTOMock);

        static::assertTrue(
            $registerTypeHandler->handle($formInterfaceMock)
        );
    }
}