<?php

declare(strict_types=1);

namespace App\UI\Form\Handler;

use App\Domain\Models\News;
use App\Helper\Interfaces\FileUploaderHelperInterface;
use App\Repository\Interfaces\NewsRepositoryInterface;
use App\UI\Form\Handler\Interfaces\AddNewsTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AddNewsTypeHandler implements AddNewsTypeHandlerInterface
{
    /**
     * @var NewsRepositoryInterface
     */
    private $newsRepository;

    /**
     * @var FileUploaderHelperInterface
     */
    private $fileUploaderHelper;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * AddNewsTypeHandler constructor.
     *
     * @param NewsRepositoryInterface     $newsRepository
     * @param FileUploaderHelperInterface $fileUploaderHelper
     * @param ValidatorInterface          $validator
     * @param TokenStorageInterface       $tokenStorage
     */
    public function __construct (
        NewsRepositoryInterface $newsRepository,
        FileUploaderHelperInterface $fileUploaderHelper,
        ValidatorInterface $validator,
        TokenStorageInterface $tokenStorage
    ) {
        $this->newsRepository = $newsRepository;
        $this->fileUploaderHelper = $fileUploaderHelper;
        $this->validator = $validator;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @param FormInterface $form
     *
     * @return bool
     */
    public function handle(FormInterface $form): bool
    {
        if($form->isSubmitted() && $form->isValid()) {

            if (!\is_null($form->getData()->image)) {
                $image = $form->getData()->image;
                $imageName = $this->fileUploaderHelper->upload($image);
            }

            $news = new News(
                $form->getData()->content,
                $form->getData()->title,
                $this->tokenStorage->getToken()->getUser(),
                $imageName ?? null
            );

            $this->validator->validate($news, [], [
                'addnews'
            ]);

            $this->newsRepository->save($news);

            return true;
        }
        return false;
    }
}
