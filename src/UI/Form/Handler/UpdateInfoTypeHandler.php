<?php

declare(strict_types=1);

namespace App\UI\Form\Handler;

use App\Domain\Models\Interfaces\InfosInterface;
use App\Repository\Interfaces\InfosRepositoryInterface;
use App\UI\Form\Handler\Interfaces\UpdateInfoTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;
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
     * UpdateInfoTypeHandler constructor.
     *
     * @param InfosRepositoryInterface $infosRepository
     * @param ValidatorInterface       $validator
     */
    public function __construct (
        InfosRepositoryInterface $infosRepository,
        ValidatorInterface $validator
    ) {
        $this->infosRepository = $infosRepository;
        $this->validator = $validator;
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
            $updateInfo = $infos->update(
                $form->getData()->title,
                $form->getData()->author,
                $form->getData()->image,
                $form->getData()->category,
                $form->getData()->content
            );

            $this->validator->validate($updateInfo, [], [
                'addinfo'
            ]);

            $this->infosRepository->update();
            return true;
        }
        return false;
    }
}
