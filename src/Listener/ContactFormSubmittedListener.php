<?php
declare(strict_types=1);

namespace App\Listener;

use App\Event\ContactFormSubmittedEvent;

class ContactFormSubmittedListener
{
    public function onContactFormSubmitted(ContactFormSubmittedEvent $event, \Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom()
            ->setTo()
            ->setBody(
                'text/html'
            );

        $mailer->send($message);
    }
}