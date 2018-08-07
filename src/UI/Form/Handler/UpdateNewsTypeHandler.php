<?php

declare(strict_types=1);

namespace App\UI\Form\Handler;

use App\Domain\Models\Interfaces\NewsInterface;
use App\Repository\Interfaces\NewsRepositoryInterface;
use App\UI\Form\Handler\Interfaces\UpdateNewsTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UpdateNewsTypeHandler implements UpdateNewsTypeHandlerInterface
{
    /**
     * @var NewsRepositoryInterface
     */
    private $newsRepository;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * UpdateNewsTypeHandler constructor.
     *
     * @param NewsRepositoryInterface $newsRepository
     * @param ValidatorInterface      $validator
     */
    public function __construct (
        NewsRepositoryInterface $newsRepository,
        ValidatorInterface $validator
    ) {
        $this->newsRepository = $newsRepository;
        $this->validator = $validator;
    }

    /**
     * @param FormInterface  $form
     * @param NewsInterface $news
     *
     * @return bool
     */
    public function handle(FormInterface $form, NewsInterface $news): bool
    {
        if($form->isSubmitted() && $form->isValid()) {
            $updateNews = $news->update(
                $form->getData()->title,
                $form->getData()->author,
                $form->getData()->image,
                $form->getData()->content
            );

            $this->validator->validate($updateNews, [], [
                'updateinfo'
            ]);

            $this->newsRepository->update();

            return true;
        }
        return false;
    }
}
