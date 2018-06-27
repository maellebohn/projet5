<?php

declare(strict_types=1);

namespace App\UI\Form\Handler\Interfaces;

use App\Domain\Models\Interfaces\NewsInterface;
use App\Repository\Interfaces\NewsRepositoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

interface UpdateNewsTypeHandlerInterface
{
    /**
     * UpdateNewsTypeHandler constructor.
     *
     * @param NewsRepositoryInterface $newsRepository
     * @param ValidatorInterface      $validator
     */
    public function __construct (
        NewsRepositoryInterface $newsRepository,
        ValidatorInterface $validator
    );

    /**
     * @param FormInterface $form
     * @param NewsInterface $news
     *
     * @return bool
     */
    public function handle(FormInterface $form, NewsInterface $news): bool;
}
