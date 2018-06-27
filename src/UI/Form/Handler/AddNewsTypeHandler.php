<?php

declare(strict_types=1);

namespace App\UI\Form\Handler;

use App\Domain\Models\News;
use App\Helper\FileUploaderHelper;
use App\Repository\Interfaces\NewsRepositoryInterface;
use App\UI\Form\Handler\Interfaces\AddNewsTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;

class AddNewsTypeHandler implements AddNewsTypeHandlerInterface
{
    /**
     * @var NewsRepositoryInterface
     */
    private $newsRepository;

    /**
     * @var fileUploaderHelper
     */
    private $fileUploaderHelper;

    /**
     * AddNewsTypeHandler constructor.
     *
     * @param NewsRepositoryInterface $newsRepository
     * @param FileUploaderHelper      $fileUploaderHelper
     */
    public function __construct (
        NewsRepositoryInterface $newsRepository,
        FileUploaderHelper $fileUploaderHelper
    ) {
        $this->newsRepository = $newsRepository;
        $this->fileUploaderHelper = $fileUploaderHelper;
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

            $this->newsRepository->save($news);

            return true;
        }
        return false;
    }
}
