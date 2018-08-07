<?php

declare(strict_types=1);

namespace App\UI\Action;

use App\Domain\DTO\UpdateInfoDTO;
use App\Repository\Interfaces\InfosRepositoryInterface;
use App\UI\Action\Interfaces\UpdateInfoActionInterface;
use App\UI\Form\Handler\Interfaces\UpdateInfoTypeHandlerInterface;
use App\UI\Form\Type\UpdateInfoType;
use App\UI\Responder\Interfaces\UpdateInfoResponderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(
 *     path="/updateinfo/{id}",
 *     name="update_info"
 * )
 */
// @Security("is_granted('ROLE_ADMIN')")
class UpdateInfoAction implements UpdateInfoActionInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var InfosRepositoryInterface
     */
    private $infosRepository;

    /**
     * @var UpdateInfoTypeHandlerInterface
     */
    private $updateInfoTypeHandler;

    /**
     * UpdateInfoAction constructor.
     *
     * @param InfosRepositoryInterface       $infosRepository
     * @param FormFactoryInterface           $formFactory
     * @param UpdateInfoTypeHandlerInterface $updateInfoTypeHandler
     */
    public function __construct (
        InfosRepositoryInterface $infosRepository,
        FormFactoryInterface $formFactory,
        UpdateInfoTypeHandlerInterface $updateInfoTypeHandler
    ) {
        $this->infosRepository = $infosRepository;
        $this->formFactory = $formFactory;
        $this->updateInfoTypeHandler = $updateInfoTypeHandler;
    }


    /**
     * @param Request                      $request
     * @param UpdateInfoResponderInterface $responder
     *
     * @return mixed|\Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(
        Request $request,
        UpdateInfoResponderInterface $responder
    ) {
        $infos = $this->infosRepository->findOneBy(['id' => $request->attributes->get('id')]);
        $dto = new UpdateInfoDTO(
            $infos->getTitle(),
            $infos->getAuthor(),
            $infos->getImage(),
            $infos->getCategory(),
            $infos->getContent()
        );

        $updateInfoType = $this->formFactory->create(UpdateInfoType::class, $dto)
                                            ->handleRequest($request);

        if($this->updateInfoTypeHandler->handle($updateInfoType, $infos)) {
            return $responder(true);
        }

        return $responder(false, $infos, $updateInfoType);
    }
}
