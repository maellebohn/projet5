<?php

declare(strict_types=1);

namespace App\UI\Form\Handler;

use App\Domain\Builder\Interfaces\InfoBuilderInterface;
use App\Domain\DTO\NewInfoDTO;
use App\Repository\Interfaces\InfosRepositoryInterface;
use App\UI\Form\Handler\Interfaces\AddInfoTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;

class AddInfoTypeHandler implements AddInfoTypeHandlerInterface
{
    /**
     * @var NewInfoDTO
     */
    private $newInfoDTO;


    /**
     * @var InfosRepositoryInterface
     */
    private $infosRepository;

    public function __construct (
        //NewInfoDTO $newInfoDTO,
        InfosRepositoryInterface $infosRepository
    ) {
        //$this->newInfoDTO = $newInfoDTO;
        $this->infosRepository = $infosRepository;
    }

    /**
     * @param FormInterface $form
     * @return bool
     */
    public function handle(FormInterface $form): bool
    {
        if($form->isSubmitted() && $form->isValid()) {
            $info = new Infos($form->getData()->title, $author, $image, $content);
            $this->newInfoDTO->create(
                $form->getData()->title,
                $form->getData()->author,
                $form->getData()->image,
                $form->getData()->content
            );

            $this->infosRepository->save($this->infoBuilder->getInfo());

            return true;
        }
        return false;
    }
}
