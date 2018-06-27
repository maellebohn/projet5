<?php

declare(strict_types=1);

namespace App\UI\Form\Handler\Interfaces;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

interface ContactTypeHandlerInterface
{
    /**
     * ContactTypeHandler constructor.
     *
     * @param EventDispatcherInterface $eventDispatcher
     * @param SessionInterface         $session
     */
    public function __construct (
        EventDispatcherInterface $eventDispatcher,
        SessionInterface $session
    );

    /**
    *@param FormInterface $form
    *@return bool
    */
    public function handle(FormInterface $form): bool;
}
