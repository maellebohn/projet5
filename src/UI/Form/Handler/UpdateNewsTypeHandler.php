<?php

declare(strict_types=1);

namespace App\UI\Form\Handler;

use App\Domain\Models\Interfaces\NewsInterface;
use App\Repository\Interfaces\NewsRepositoryInterface;
use App\UI\Form\Handler\Interfaces\UpdateNewsTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
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
     * @var TokenStorageInterface
     */
    private $tokenStorage;

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
    ) {
        $this->newsRepository = $newsRepository;
        $this->validator = $validator;
        $this->tokenStorage = $tokenStorage;
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

            if (!\is_null($form->getData()->image)) {
                $image = $form->getData()->image;
                $imageName = $this->fileUploaderHelper->upload($image);
            }

            $updateNews = $news->update($form->getData());
            //userinterface a implementer comment et image comment je la recupere ?

            $this->validator->validate($updateNews, [], [
                'updateinfo'
            ]);

            $this->newsRepository->update();

            return true;
        }
        return false;
    }
}
