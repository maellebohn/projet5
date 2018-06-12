<?php

declare(strict_types=1);

namespace App\UI\Form\Handler;

use App\Event\ReservationFormSubmittedEvent;
use App\Event\Interfaces\ReservationFormSubmittedEventInterface;
use App\UI\Form\Handler\Interfaces\ReservationTypeHandlerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormInterface;

class ReservationTypeHandler implements ReservationTypeHandlerInterface
{
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * ReservationTypeHandler constructor.
     *
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct (EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param FormInterface $form
     * @return bool
     */
    public function handle(FormInterface $form): bool
    {
        if($form->isSubmitted() && $form->isValid()) {
            $this->eventDispatcher->dispatch(ReservationFormSubmittedEventInterface::NAME, new ReservationFormSubmittedEvent($form->getData()));
            return true;
        }
        return false;
    }
}
