<?php

declare(strict_types=1);

namespace App\Tests\UI\Form\Handler;

use App\Domain\DTO\NewContactFormSubmittedDTO;
use App\UI\Form\Handler\ContactTypeHandler;
use App\UI\Form\Handler\Interfaces\ContactTypeHandlerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ContactTypeHandlerTest extends KernelTestCase
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
    public function setUp ()
    {
        static::bootKernel();

        $this->eventDispatcher = static::$kernel->getContainer()->get('event_dispatcher');
        $this->session = $this->createMock(SessionInterface::class);
        //new session storage
    }

    public function testConstruct ()
    {
        $contactTypeHandler = new ContactTypeHandler(
            $this->eventDispatcher,
            $this->session
        );

        static::assertInstanceOf(
            ContactTypeHandlerInterface::class,
            $contactTypeHandler
        );
    }

    public function testWrongHandlingProcess ()
    {
        $formInterfaceMock = $this->createMock(FormInterface::class);

        $contactTypeHandler = new ContactTypeHandler(
            $this->eventDispatcher,
            $this->session
        );

        $formInterfaceMock->method('isValid')->willReturn(false);
        $formInterfaceMock->method('isSubmitted')->willReturn(false);

        static::assertFalse(
            $contactTypeHandler->handle($formInterfaceMock)
        );
    }

    public function testRightHandlingProcess ()
    {
        $formInterfaceMock = $this->createMock(FormInterface::class);

        $newContactFormSubmittedDTOMock = new NewContactFormSubmittedDTO(
            'toto',
            'toto@gmail.com',
            'hello'
        );

        $contactTypeHandler = new ContactTypeHandler(
            $this->eventDispatcher,
            $this->session
        );

        $formInterfaceMock->method('isValid')->willReturn(true);
        $formInterfaceMock->method('isSubmitted')->willReturn(true);
        $formInterfaceMock->method('getData')->willReturn($newContactFormSubmittedDTOMock);

        static::assertTrue(
            $contactTypeHandler->handle($formInterfaceMock)
        );
    }
}