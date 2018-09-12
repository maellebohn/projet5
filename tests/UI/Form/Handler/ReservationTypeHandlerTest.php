<?php

declare(strict_types=1);

namespace App\Tests\UI\Form\Handler;

use App\Domain\DTO\NewReservationFormSubmittedDTO;
use App\UI\Form\Handler\ReservationTypeHandler;
use App\UI\Form\Handler\Interfaces\ReservationTypeHandlerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

class ReservationTypeHandlerTest extends KernelTestCase
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
     *{@inheritdoc}
     */
    protected function setUp ()
    {
        static::bootKernel();

        $this->eventDispatcher = static::$kernel->getContainer()->get('event_dispatcher');
        $this->session = new Session(new MockArraySessionStorage());
    }

    public function testConstruct ()
    {
        $reservationTypeHandler = new ReservationTypeHandler(
            $this->eventDispatcher,
            $this->session
        );

        static::assertInstanceOf(
            ReservationTypeHandlerInterface::class,
            $reservationTypeHandler
        );
    }

    public function testWrongHandlingProcess ()
    {
        $formInterfaceMock = $this->createMock(FormInterface::class);

        $reservationTypeHandler = new ReservationTypeHandler(
            $this->eventDispatcher,
            $this->session
        );

        $formInterfaceMock->method('isValid')->willReturn(false);
        $formInterfaceMock->method('isSubmitted')->willReturn(false);

        static::assertFalse(
            $reservationTypeHandler->handle($formInterfaceMock)
        );
    }

    public function testRightHandlingProcess ()
    {
        $formInterfaceMock = $this->createMock(FormInterface::class);

        $newReservationFormSubmittedDTOMock = new NewReservationFormSubmittedDTO(
            'toto',
            'toto@gmail.com',
            'hello'
        );

        $reservationTypeHandler = new ReservationTypeHandler(
            $this->eventDispatcher,
            $this->session
        );

        $formInterfaceMock->method('isValid')->willReturn(true);
        $formInterfaceMock->method('isSubmitted')->willReturn(true);
        $formInterfaceMock->method('getData')->willReturn($newReservationFormSubmittedDTOMock);

        static::assertTrue(
            $reservationTypeHandler->handle($formInterfaceMock)
        );
    }
}