<?php

declare(strict_types=1);

namespace App\UI\Form\Handler\Interfaces;

use App\Domain\Models\Interfaces\NewsInterface;
use App\Repository\Interfaces\NewsRepositoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

interface UpdateNewsTypeHandlerInterface
{
    /**
     * UpdateNewsTypeHandler constructor.
     *
     * @param NewsRepositoryInterface $newsRepository
     * @param ValidatorInterface      $validator
     * @param TokenStorageInterface   $tokenStorage
     */
    public function __construct (
        NewsRepositoryInterface $newsRepository,
        ValidatorInterface $validator,
        TokenStorageInterface $tokenStorage
    );

    /**
     * @param FormInterface $form
     * @param NewsInterface $news
     *
     * @return bool
     */
    public function handle(FormInterface $form, NewsInterface $news): bool;
}
