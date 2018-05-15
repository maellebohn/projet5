<?php

declare(strict_types=1);

namespace App\UI\Form\Handler;

use App\Event\ContactFormSubmittedEvent;
use App\Event\Interfaces\ContactFormSubmittedEventInterface;
use App\UI\Form\Handler\Interfaces\ContactTypeHandlerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormInterface;

class ContactTypeHandler implements ContactTypeHandlerInterface
{
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * ContactTypeHandler constructor.
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
            $this->eventDispatcher->dispatch(ContactFormSubmittedEventInterface::NAME, new ContactFormSubmittedEvent($form->getData()));
            return true;
        }
        return false;
    }
}
