<?php

declare(strict_types=1);

namespace App\UI\Form\Handler\Interfaces;

use App\Helper\Interfaces\FileUploaderHelperInterface;
use App\Repository\Interfaces\NewsRepositoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

interface AddNewsTypeHandlerInterface
{
    /**
     * AddNewsTypeHandler constructor.
     *
     * @param NewsRepositoryInterface    $newsRepository
     * @param FileUploaderHelperInterface $fileUploaderHelper
     * @param ValidatorInterface          $validator
     */
    public function __construct (
        NewsRepositoryInterface $newsRepository,
        FileUploaderHelperInterface $fileUploaderHelper,
        ValidatorInterface $validator
    );

    /**
    *@param FormInterface $form
    *@return bool
    */
    public function handle(FormInterface $form): bool;
}
