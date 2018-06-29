<?php

declare(strict_types=1);

namespace App\UI\Form\Handler;

use App\Domain\Models\Infos;
use App\Helper\Interfaces\FileUploaderHelperInterface;
use App\Repository\Interfaces\InfosRepositoryInterface;
use App\UI\Form\Handler\Interfaces\AddInfoTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AddInfoTypeHandler implements AddInfoTypeHandlerInterface
{
    /**
     * @var InfosRepositoryInterface
     */
    private $infosRepository;

    /**
     * @var FileUploaderHelperInterface
     */
    private $fileUploaderHelper;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * AddInfoTypeHandler constructor.
     *
     * @param InfosRepositoryInterface    $infosRepository
     * @param FileUploaderHelperInterface $fileUploaderHelper
     * @param ValidatorInterface          $validator
     */
    public function __construct (
        InfosRepositoryInterface $infosRepository,
        FileUploaderHelperInterface $fileUploaderHelper,
        ValidatorInterface $validator
    ) {
        $this->infosRepository = $infosRepository;
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

            $info = new Infos(
                $form->getData()->title,
                $form->getData()->author,
                $imageName,
                $form->getData()->category,
                $form->getData()->content
            );

            $this->validator->validate($info, [], [
                'addinfo'
            ]);

            $this->infosRepository->save($info);

            return true;
        }
        return false;
    }
}
