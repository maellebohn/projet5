<?php

namespace App\Event\Interfaces;

use App\Domain\DTO\NewContactFormSubmittedDTO;

interface ContactFormSubmittedEventInterface
{
    const NAME = 'contactform.submitted';

    public function __construct (NewContactFormSubmittedDTO $newContactFormSubmittedDTO);

    public function getNewContactFormSubmittedDTO(): NewContactFormSubmittedDTO;
}