<?php

declare(strict_types=1);

namespace App\UI\Form\Handler;

use App\Domain\Models\Birds;
use App\Repository\Interfaces\BirdsRepositoryInterface;
use App\UI\Form\Handler\Interfaces\AddBirdTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AddBirdTypeHandler implements AddBirdTypeHandlerInterface
{
    /**
     * @var BirdsRepositoryInterface
     */
    private $birdsRepository;

    /**
     * AddBirdTypeHandler constructor.
     *
     * @param BirdsRepositoryInterface $birdsRepository
     */
    public function __construct (BirdsRepositoryInterface $birdsRepository)
    {
        $this->birdsRepository = $birdsRepository;
    }

    /**
     * @param FormInterface $form
     * @return bool
     */
    public function handle(FormInterface $form): bool
    {
        if($form->isSubmitted() && $form->isValid()) {

            $bird = new Birds(
                $form->getData()->name,
                $form->getData()->birthdate,
                $form->getData()->description,
                $form->getData()->price
            );
            //$this->validator->validate($bird, [], [
            //    'addbird'
            //]);

            $this->birdsRepository->save($bird);

            return true;
        }
        return false;
    }
}
