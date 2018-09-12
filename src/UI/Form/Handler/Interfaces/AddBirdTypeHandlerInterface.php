<?php

declare(strict_types=1);

namespace App\UI\Form\Handler\Interfaces;

use App\Repository\Interfaces\BirdsRepositoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

interface AddBirdTypeHandlerInterface
{
    /**
     * AddBirdTypeHandler constructor.
     *
     * @param BirdsRepositoryInterface $birdsRepository
     * @param ValidatorInterface       $validator

     */
    public function __construct (
        BirdsRepositoryInterface $birdsRepository,
        ValidatorInterface $validator
    );

    /**
     * @param FormInterface $form
     *
     * @return bool
     */
    public function handle(FormInterface $form): bool;
}
