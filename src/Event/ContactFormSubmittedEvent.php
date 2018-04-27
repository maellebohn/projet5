<?php

declare(strict_types=1);

namespace App\Event;

use Symfony\Component\EventDispatcher\Event;

class ContactFormSubmittedEvent extends Event
{
    const NAME = 'contactform.submitted';
}