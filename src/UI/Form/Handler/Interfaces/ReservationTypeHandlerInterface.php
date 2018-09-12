<?php

declare(strict_types=1);

namespace App\UI\Form\Handler\Interfaces;

use App\Domain\Models\Interfaces\BirdsInterface;
use App\Repository\Interfaces\BirdsRepositoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

interface ReservationTypeHandlerInterface
{
    /**
     * ReservationTypeHandler constructor.
     *
     * @param EventDispatcherInterface $eventDispatcher
     * @param SessionInterface         $session
     * @param BirdsRepositoryInterface $bird
     */
    public function __construct (
        EventDispatcherInterface $eventDispatcher,
        SessionInterface $session,
        BirdsRepositoryInterface $bird
    );

    /**
     * @param FormInterface  $form
     * @param BirdsInterface $bird
     *
     * @return bool
     */
    public function handle(FormInterface $form): bool;
}
