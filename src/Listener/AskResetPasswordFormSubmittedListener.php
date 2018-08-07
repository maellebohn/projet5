<?php

declare(strict_types=1);

namespace App\Listener;

use App\Event\Interfaces\AskResetPasswordFormSubmittedEventInterface;
use Twig\Environment;

class AskResetPasswordFormSubmittedListener
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
     * ContactFormSubmittedListener constructor.
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
     * @param AskResetPasswordFormSubmittedEventInterface $event
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function onAskResetPasswordFormSubmitted(AskResetPasswordFormSubmittedEventInterface $event)
    {
        $message = (new \Swift_Message('Réinitialisation du mot de passe'))
            ->setFrom('bohnmaelle@gmail.com')
            ->setTo($event->getUser()->getEmail())
            ->setBody(
                $this->twig->render('resetpasswordemail.html.twig', [
                    'users' => $event->getUser(),
                ]),
                'text/html'
            );

        $this->mailer->send($message);
    }
}