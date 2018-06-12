<?php

declare(strict_types=1);

namespace App\UI\Form\Handler\Interfaces;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

interface ReservationTypeHandlerInterface
{
    /**
     * ReservationTypeHandler constructor.
     *
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct (EventDispatcherInterface $eventDispatcher);

    /**
    *@param FormInterface $form
    *@return bool
    */
    public function handle(FormInterface $form): bool;
}
