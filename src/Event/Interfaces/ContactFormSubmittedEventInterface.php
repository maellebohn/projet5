<?php

namespace App\Event\Interfaces;

use App\Domain\DTO\NewContactFormSubmittedDTO;

interface ContactFormSubmittedEventInterface
{
    const NAME = 'contactform.submitted';

    /**
     * ContactFormSubmittedEvent constructor.
     *
     * @param NewContactFormSubmittedDTO $newContactFormSubmittedDTO
     */
    public function __construct (NewContactFormSubmittedDTO $newContactFormSubmittedDTO);

    /**
     * @return NewContactFormSubmittedDTO
     */
    public function getNewContactFormSubmittedDTO(): NewContactFormSubmittedDTO;
}