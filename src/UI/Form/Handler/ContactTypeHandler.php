<?php

namespace App\UI\Form\Handler;

use Symfony\Component\Form\FormInterface;
use App\UI\Form\Handler\Interfaces\ContactTypeHandlerInterface;

class ContactTypeHandler implements ContactTypeHandlerInterface
{
    public function handle(FormInterface $form): bool
    {
        if($form->isSubmitted() && $form->isValid()) {
            //doctrine
            return true;
        }
        return false;
    }
}
