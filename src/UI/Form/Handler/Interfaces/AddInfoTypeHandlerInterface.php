<?php

declare(strict_types=1);

namespace App\UI\Form\Handler\Interfaces;

use App\Helper\FileUploaderHelper;
use App\Repository\Interfaces\InfosRepositoryInterface;
use Symfony\Component\Form\FormInterface;

interface AddInfoTypeHandlerInterface
{
    /**
     * AddInfoTypeHandler constructor.
     *
     * @param InfosRepositoryInterface $infosRepository
     * @param FileUploaderHelper       $fileUploaderHelper
     */
    public function __construct (
        InfosRepositoryInterface $infosRepository,
        FileUploaderHelper $fileUploaderHelper
    );

    /**
    *@param FormInterface $form
    *@return bool
    */
    public function handle(FormInterface $form): bool;
}
