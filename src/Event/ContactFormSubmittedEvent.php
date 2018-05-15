<?php

declare(strict_types=1);

namespace App\Event;

use App\Domain\DTO\NewContactFormSubmittedDTO;
use App\Event\Interfaces\ContactFormSubmittedEventInterface;
use Symfony\Component\EventDispatcher\Event;

class ContactFormSubmittedEvent extends Event implements ContactFormSubmittedEventInterface
{
    private $newContactFormSubmittedDTO;

    /**
     * ContactFormSubmittedEvent constructor.
     *
     * @param NewContactFormSubmittedDTO $newContactFormSubmittedDTO
     */
    public function __construct (NewContactFormSubmittedDTO $newContactFormSubmittedDTO)
    {
        $this->newContactFormSubmittedDTO = $newContactFormSubmittedDTO;
    }

    /**
     * @return NewContactFormSubmittedDTO
     */
    public function getNewContactFormSubmittedDTO(): NewContactFormSubmittedDTO
    {
        return $this->newContactFormSubmittedDTO;
    }
}