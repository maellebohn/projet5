<?php

declare(strict_types=1);

namespace App\UI\Form\Handler;

use App\UI\Form\Handler\Interfaces\AddInfoTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;

class AddInfoTypeHandler implements AddInfoTypeHandlerInterface
{
    /**
     * @param FormInterface $form
     * @return bool
     */
    public function handle(FormInterface $form): bool
    {
        if($form->isSubmitted() && $form->isValid()) {
            return true;
        }
        return false;
    }
}
