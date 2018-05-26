<?php

declare(strict_types=1);

namespace App\UI\Form\Handler;

use App\Domain\DTO\NewInfoDTO;
use App\Domain\Models\Infos;
use App\Helper\FileUploaderHelper;
use App\Repository\Interfaces\InfosRepositoryInterface;
use App\UI\Form\Handler\Interfaces\AddInfoTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;

class AddInfoTypeHandler implements AddInfoTypeHandlerInterface
{
    /**
     * @var InfosRepositoryInterface
     */
    private $infosRepository;

    /**
     * @var fileUploaderHelper
     */
    private $fileUploaderHelper;

    public function __construct (
        InfosRepositoryInterface $infosRepository,
        FileUploaderHelper $fileUploaderHelper
    ) {
        $this->infosRepository = $infosRepository;
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

            $info = new Infos($form->getData()->title, $form->getData()->author, $imageName, $form->getData()->category, $form->getData()->content);

            $this->infosRepository->save($info);

            return true;
        }
        return false;
    }
}
