<?php

declare(strict_types=1);

namespace App\UI\Form\Handler\Interfaces;

use App\Domain\Models\Interfaces\InfosInterface;
use App\Repository\Interfaces\InfosRepositoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

interface UpdateInfoTypeHandlerInterface
{
    /**
     * UpdateInfoTypeHandler constructor.
     *
     * @param InfosRepositoryInterface $infosRepository
     * @param ValidatorInterface       $validator
     */
    public function __construct (
        InfosRepositoryInterface $infosRepository,
        ValidatorInterface $validator
    );

    /**
     * @param FormInterface  $form
     * @param InfosInterface $infos
     *
     * @return bool
     */
    public function handle(FormInterface $form, InfosInterface $infos): bool;
}
