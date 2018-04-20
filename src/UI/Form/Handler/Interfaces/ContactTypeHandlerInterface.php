<?php

namespace App\UI\Form\Handler\Interfaces;

use Symfony\Component\Form\FormInterface;

interface ContactTypeHandlerInterface
{
    /**
    *@param FormInterface $form
    *@return bool
    */

    public function handle(FormInterface $form): bool;
}
