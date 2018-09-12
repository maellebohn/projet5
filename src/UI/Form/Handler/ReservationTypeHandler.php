<?php

declare(strict_types=1);

namespace App\UI\Form\Handler;

use App\Domain\Models\Interfaces\BirdsInterface;
use App\Event\ReservationFormSubmittedEvent;
use App\Event\Interfaces\ReservationFormSubmittedEventInterface;
use App\Repository\Interfaces\BirdsRepositoryInterface;
use App\UI\Form\Handler\Interfaces\ReservationTypeHandlerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ReservationTypeHandler implements ReservationTypeHandlerInterface
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
    ) {
        $this->eventDispatcher = $eventDispatcher;
        $this->session = $session;
        $this->birdsRepository = $bird;
    }

    /**
     * @param FormInterface  $form
     *
     * @return bool
     */
    public function handle(FormInterface $form): bool
    {
        if($form->isSubmitted() && $form->isValid()) {

            $this->eventDispatcher->dispatch(ReservationFormSubmittedEventInterface::NAME, new ReservationFormSubmittedEvent($form->getData()));

            $bird = $this->birdsRepository->findOneBy(['id' => $form->getData()->id]);

            $bird->reservation();

            $this->birdsRepository->update();

            $this->session->getFlashBag()->add('success', 'Votre email a bien été envoyé !');

            return true;
        }
        return false;
    }
}
