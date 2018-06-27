<?php

declare(strict_types=1);

namespace App\UI\Form\Handler\Interfaces;

use App\Helper\FileUploaderHelper;
use App\Repository\Interfaces\NewsRepositoryInterface;
use Symfony\Component\Form\FormInterface;

interface AddNewsTypeHandlerInterface
{
    /**
     * AddNewsTypeHandler constructor.
     *
     * @param NewsRepositoryInterface $newsRepository
     * @param FileUploaderHelper       $fileUploaderHelper
     */
    public function __construct (
        NewsRepositoryInterface $newsRepository,
        FileUploaderHelper $fileUploaderHelper
    );

    /**
    *@param FormInterface $form
    *@return bool
    */
    public function handle(FormInterface $form): bool;
}
