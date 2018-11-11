<?php

declare(strict_types=1);

namespace App\Tests\UI\Form\Handler;

use App\Domain\DTO\NewReservationFormSubmittedDTO;
use App\Domain\Models\Interfaces\BirdsInterface;
use App\Repository\Interfaces\BirdsRepositoryInterface;
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
     * @var BirdsRepositoryInterface
     */
    private $birdsRepository;

    /**
     * @var BirdsInterface
     */
    private $bird;

    /**
     *{@inheritdoc}
     */
    protected function setUp ()
    {
        static::bootKernel();

        $this->eventDispatcher = static::$kernel->getContainer()->get('event_dispatcher');
        $this->session = new Session(new MockArraySessionStorage());
        $this->birdsRepository = $this->createMock(BirdsRepositoryInterface::class);
        $this->bird = $this->createMock(BirdsInterface::class);
        $this->birdsRepository->method('findOneBy')->willReturn($this->bird);
    }

    public function testConstruct ()
    {
        $reservationTypeHandler = new ReservationTypeHandler(
            $this->eventDispatcher,
            $this->session,
            $this->birdsRepository
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
            $this->session,
            $this->birdsRepository
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
            'hello',
            '1e1796b3-8e1a-452e-85d5-2b0248ed3cde'
        );

        $reservationTypeHandler = new ReservationTypeHandler(
            $this->eventDispatcher,
            $this->session,
            $this->birdsRepository
        );

        $formInterfaceMock->method('isValid')->willReturn(true);
        $formInterfaceMock->method('isSubmitted')->willReturn(true);
        $formInterfaceMock->method('getData')->willReturn($newReservationFormSubmittedDTOMock);

        static::assertTrue(
            $reservationTypeHandler->handle($formInterfaceMock)
        );
    }
}