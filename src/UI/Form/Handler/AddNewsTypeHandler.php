<?php

declare(strict_types=1);

namespace App\UI\Form\Handler;

use App\Domain\Models\News;
use App\Helper\Interfaces\FileUploaderHelperInterface;
use App\Repository\Interfaces\NewsRepositoryInterface;
use App\UI\Form\Handler\Interfaces\AddNewsTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;
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
    ) {
        $this->newsRepository = $newsRepository;
        $this->fileUploaderHelper = $fileUploaderHelper;
        $this->validator = $validator;
    }

    /**
     * @param FormInterface $form
     * @return bool
     */
    public function handle(FormInterface $form): bool
    {
        if($form->isSubmitted() && $form->isValid()) {

            $image = $form->getData()->image;
            $imageName = $this->fileUploaderHelper->upload($image);

            $news = new News(
                $form->getData()->title,
                $form->getData()->author,
                $imageName,
                $form->getData()->content
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
