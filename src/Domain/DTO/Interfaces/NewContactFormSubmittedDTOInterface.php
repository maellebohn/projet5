<?php

declare(strict_types=1);

namespace App\Event\Interfaces;


interface NewContactFormSubmittedDTOInterface
{
    /**
     * NewContactFormSubmittedDTO constructor.
     *
     * @param string $name
     * @param string $email
     * @param string $message
     */
    public function __construct(
        string $name,
        string $email,
        string $message
    );
}