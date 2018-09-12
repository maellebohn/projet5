<?php

declare(strict_types=1);

namespace App\UI\Form\Handler;

use App\Domain\Models\Infos;
use App\Helper\Interfaces\FileUploaderHelperInterface;
use App\Repository\Interfaces\InfosRepositoryInterface;
use App\UI\Form\Handler\Interfaces\AddInfoTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
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
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * AddInfoTypeHandler constructor.
     *
     * @param InfosRepositoryInterface    $infosRepository
     * @param FileUploaderHelperInterface $fileUploaderHelper
     * @param ValidatorInterface          $validator
     * @param TokenStorageInterface       $tokenStorage
     */
    public function __construct (
        InfosRepositoryInterface $infosRepository,
        FileUploaderHelperInterface $fileUploaderHelper,
        ValidatorInterface $validator,
        TokenStorageInterface $tokenStorage

    ) {
        $this->infosRepository = $infosRepository;
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

            $info = new Infos(
                $form->getData()->content,
                $form->getData()->title,
                $this->tokenStorage->getToken()->getUser(),
                $form->getData()->category,
                $imageName ?? null
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
