<?php
declare(strict_types=1);

namespace App\Listener;

use App\Event\Interfaces\ReservationFormSubmittedEventInterface;
use Twig\Environment;

class ReservationFormSubmittedListener
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var Environment
     */
    private $twig;

    /**
     * ReservationFormSubmittedListener constructor.
     *
     * @param \Swift_Mailer $mailer
     * @param Environment   $twig
     */
    public function __construct(
        \Swift_Mailer $mailer,
        Environment $twig
    ) {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    /**
     * @param ReservationFormSubmittedEventInterface $event
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function onReservationFormSubmitted(ReservationFormSubmittedEventInterface $event)
    {
        $message = (new \Swift_Message('Reservation Email'))
            ->setFrom($event->getNewReservationFormSubmittedDTO()->email)
            ->setTo('bohnmaelle@gmail.com')
            ->setBody(
                $this->twig->render('reservationemail.html.twig', [
                    'name' => $event->getNewReservationFormSubmittedDTO()->name,
                    'email' => $event->getNewReservationFormSubmittedDTO()->email,
                    'message' => $event->getNewReservationFormSubmittedDTO()->message
                ]),
                'text/html'
            );

        $this->mailer->send($message);
    }
}