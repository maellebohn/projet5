<?php

declare(strict_types=1);

namespace App\UI\Form\Handler;

use App\UI\Form\Handler\Interfaces\ContactTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;

class ContactTypeHandler implements ContactTypeHandlerInterface
{
    public function handle(FormInterface $form): bool
    {
        if($form->isSubmitted() && $form->isValid()) {
            return true;
        }
        return false;
    }
}
