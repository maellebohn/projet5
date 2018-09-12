<?php

declare(strict_types=1);

namespace App\UI\Form\Handler\Interfaces;

use App\Helper\Interfaces\FileUploaderHelperInterface;
use App\Repository\Interfaces\InfosRepositoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

interface AddInfoTypeHandlerInterface
{
    /**
     * AddInfoTypeHandler constructor.
     *
     * @param InfosRepositoryInterface    $infosRepository
     * @param FileUploaderHelperInterface $fileUploaderHelper
     * @param ValidatorInterface          $validator
     * @param TokenStorageInterface       $tokenStorage
     */
    public function __construct (
        InfosRepositoryInterface $infosRepository,
        FileUploaderHelperInterface $fileUploaderHelper,
        ValidatorInterface $validator,
        TokenStorageInterface $tokenStorage

    );

    /**
     * @param FormInterface $form
     *
     * @return bool
     */
    public function handle(FormInterface $form): bool;
}
