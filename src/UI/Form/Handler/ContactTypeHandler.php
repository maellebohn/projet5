<?php

declare(strict_types=1);

namespace App\UI\Form\Handler;

use App\Event\ContactFormSubmittedEvent;
use App\Event\Interfaces\ContactFormSubmittedEventInterface;
use App\UI\Form\Handler\Interfaces\ContactTypeHandlerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ContactTypeHandler implements ContactTypeHandlerInterface
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
     * ContactTypeHandler constructor.
     *
     * @param EventDispatcherInterface $eventDispatcher
     * @param SessionInterface         $session
     */
    public function __construct (
        EventDispatcherInterface $eventDispatcher,
        SessionInterface $session
    ) {
        $this->eventDispatcher = $eventDispatcher;
        $this->session = $session;
    }

    /**
     * @param FormInterface $form
     *
     * @return bool
     */
    public function handle(FormInterface $form): bool
    {
        if($form->isSubmitted() && $form->isValid()) {
            $this->eventDispatcher->dispatch(ContactFormSubmittedEventInterface::NAME, new ContactFormSubmittedEvent($form->getData()));

            $this->session->getFlashBag()->add('success', 'Votre email a bien été envoyé !');

            return true;
        }
        return false;
    }
}
