<?php

declare(strict_types=1);

namespace App\UI\Form\Handler\Interfaces;

use App\Repository\Interfaces\UsersRepositoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

interface AskResetPasswordTypeHandlerInterface
{
    /**
    *@param FormInterface $form
    *@return bool
    */
    public function handle(FormInterface $form): bool;
}
