<?php

declare(strict_types=1);

namespace App\UI\Action;

use App\Domain\DTO\UpdateBirdDTO;
use App\Repository\Interfaces\BirdsRepositoryInterface;
use App\UI\Action\Interfaces\UpdateBirdActionInterface;
use App\UI\Form\Handler\Interfaces\UpdateBirdTypeHandlerInterface;
use App\UI\Form\Type\UpdateBirdType;
use App\UI\Responder\Interfaces\UpdateBirdResponderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(
 *     path="/updatebird/{id}",
 *     name="update_bird"
 * )
 */
// @Security("is_granted('ROLE_ADMIN')")
class UpdateBirdAction implements UpdateBirdActionInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var BirdsRepositoryInterface
     */
    private $birdsRepository;

    /**
     * @var UpdateBirdTypeHandlerInterface
     */
    private $updateBirdTypeHandler;

    /**
     * UpdateBirdAction constructor.
     *
     * @param BirdsRepositoryInterface       $birdsRepository
     * @param FormFactoryInterface           $formFactory
     * @param UpdateBirdTypeHandlerInterface $updateBirdTypeHandler
     */
    public function __construct (
        BirdsRepositoryInterface $birdsRepository,
        FormFactoryInterface $formFactory,
        UpdateBirdTypeHandlerInterface $updateBirdTypeHandler
    ) {
        $this->birdsRepository = $birdsRepository;
        $this->formFactory = $formFactory;
        $this->updateBirdTypeHandler = $updateBirdTypeHandler;
    }

    /**
     * @param Request                      $request
     * @param UpdateBirdResponderInterface $responder
     *
     * @return mixed
     */
    public function __invoke(
        Request $request,
        UpdateBirdResponderInterface $responder
    ) {
        $bird = $this->birdsRepository->findOneBy(['id' => $request->attributes->get('id')]);
        $dto = new UpdateBirdDTO(
            $bird->getName(),
            $bird->getBirthdate(),
            $bird->getPrice(),
            $bird->getDescription()
        );

        $updateBirdType = $this->formFactory->create(UpdateBirdType::class, $dto)
                                            ->handleRequest($request);

        if($this->updateBirdTypeHandler->handle($updateBirdType, $bird)) {
            return $responder(true);
        }

        return $responder(false, $bird, $updateBirdType);
    }
}
