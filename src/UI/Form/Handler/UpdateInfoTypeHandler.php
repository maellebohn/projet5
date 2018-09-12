<?php

declare(strict_types=1);

namespace App\UI\Form\Handler;

use App\Domain\Models\Interfaces\InfosInterface;
use App\Repository\Interfaces\InfosRepositoryInterface;
use App\UI\Form\Handler\Interfaces\UpdateInfoTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UpdateInfoTypeHandler implements UpdateInfoTypeHandlerInterface
{
    /**
     * @var InfosRepositoryInterface
     */
    private $infosRepository;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * UpdateInfoTypeHandler constructor.
     *
     * @param InfosRepositoryInterface $infosRepository
     * @param ValidatorInterface       $validator
     * @param TokenStorageInterface    $tokenStorage
     */
    public function __construct (
        InfosRepositoryInterface $infosRepository,
        ValidatorInterface $validator,
        TokenStorageInterface $tokenStorage
    ) {
        $this->infosRepository = $infosRepository;
        $this->validator = $validator;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @param FormInterface  $form
     * @param InfosInterface $infos
     *
     * @return bool
     */
    public function handle(FormInterface $form, InfosInterface $infos): bool
    {
        if($form->isSubmitted() && $form->isValid()) {

            if (!\is_null($form->getData()->image)) {
                $image = $form->getData()->image;
                $imageName = $this->fileUploaderHelper->upload($image);
            }

            $updateInfo = $infos->update($form->getData());

            $this->validator->validate($updateInfo, [], [
                'updateinfo'
            ]);

            $this->infosRepository->update();

            return true;
        }
        return false;
    }
}
