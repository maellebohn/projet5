<?php

declare(strict_types=1);

namespace App\UI\Action;

use App\Repository\Interfaces\InfosRepositoryInterface;
use App\UI\Action\Interfaces\GetInfoActionInterface;
use App\UI\Responder\Interfaces\GetInfoResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(
 *     path="/info/{id}",
 *     name="get_info"
 * )
 */
class GetInfoAction implements GetInfoActionInterface
{
    /**
     * @var InfosRepositoryInterface
     */
    private $infosRepository;

    /**
     * GetInfoAction constructor.
     *
     * @param InfosRepositoryInterface $infosRepository
     */
    public function __construct (InfosRepositoryInterface $infosRepository)
    {
        $this->infosRepository = $infosRepository;
    }

    /**
     * @param Request                   $request
     * @param GetInfoResponderInterface $responder
     *
     * @return mixed|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(
        Request $request,
        GetInfoResponderInterface $responder
    ) {
        return $responder($this->infosRepository->findOneBy(['id' => $request->attributes->get('id')]));
    }
}
