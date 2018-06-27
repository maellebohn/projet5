<?php
declare(strict_types=1);

namespace App\Listener;

use App\Event\Interfaces\ContactFormSubmittedEventInterface;
use Twig\Environment;

class ContactFormSubmittedListener
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
     * @param ContactFormSubmittedEventInterface $event
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function onContactFormSubmitted(ContactFormSubmittedEventInterface $event)
    {
        $message = (new \Swift_Message('Contact Email'))
            ->setFrom($event->getNewContactFormSubmittedDTO()->email)
            ->setTo('bohnmaelle@gmail.com')
            ->setBody(
                $this->twig->render('contactemail.html.twig', [
                    'name' => $event->getNewContactFormSubmittedDTO()->name,
                    'email' => $event->getNewContactFormSubmittedDTO()->email,
                    'message' => $event->getNewContactFormSubmittedDTO()->message
                ]),
                'text/html'
            );

        $this->mailer->send($message);
    }
}