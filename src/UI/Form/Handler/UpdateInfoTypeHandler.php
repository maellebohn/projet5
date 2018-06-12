<?php

declare(strict_types=1);

namespace App\UI\Form\Handler;

use App\Domain\Models\Interfaces\InfosInterface;
use App\Repository\Interfaces\InfosRepositoryInterface;
use App\UI\Form\Handler\Interfaces\UpdateInfoTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;

class UpdateInfoTypeHandler implements UpdateInfoTypeHandlerInterface
{
    /**
     * @var InfosRepositoryInterface
     */
    private $infosRepository;

    /**
     * AddInfoTypeHandler constructor.
     *
     * @param InfosRepositoryInterface $infosRepository
     */
    public function __construct (InfosRepositoryInterface $infosRepository)
    {
        $this->infosRepository = $infosRepository;
    }

    /**
     * @param FormInterface $form
     * @return bool
     */
    public function handle(FormInterface $form): bool
    {
        if($form->isSubmitted() && $form->isValid()) {
            //$updateInfo = $infos->update();
            //$this->validator->validate($updateInfo, [], [
            //    'addinfo'
            //]);
            //
            $this->infosRepository->update();
            return true;
        }
        return false;
    }
}
