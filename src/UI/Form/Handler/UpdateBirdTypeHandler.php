<?php

declare(strict_types=1);

namespace App\UI\Form\Handler;

use App\Domain\Models\Interfaces\BirdsInterface;
use App\Repository\Interfaces\BirdsRepositoryInterface;
use App\UI\Form\Handler\Interfaces\UpdateBirdTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UpdateBirdTypeHandler implements UpdateBirdTypeHandlerInterface
{
    /**
     * @var BirdsRepositoryInterface
     */
    private $birdsRepository;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * UpdateBirdTypeHandler constructor.
     *
     * @param BirdsRepositoryInterface $birdsRepository
     * @param ValidatorInterface       $validator
     */
    public function __construct (
        BirdsRepositoryInterface $birdsRepository,
        ValidatorInterface $validator
    ) {
        $this->birdsRepository = $birdsRepository;
        $this->validator = $validator;
    }

    /**
     * @param FormInterface  $form
     * @param BirdsInterface $bird
     *
     * @return bool
     */
    public function handle(FormInterface $form, BirdsInterface $bird): bool
    {
        if($form->isSubmitted() && $form->isValid()) {
            $updateBird = $bird->update(
                $form->getData()->title,
                $form->getData()->author,
                $form->getData()->image,
                $form->getData()->content
            );

            $this->validator->validate($updateBird, [], [
                'updatebird'
            ]);

            $this->birdsRepository->update();

            return true;
        }
        return false;
    }
}
