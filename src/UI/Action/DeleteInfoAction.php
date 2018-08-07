<?php

declare(strict_types=1);

namespace App\UI\Action;

use App\Repository\Interfaces\InfosRepositoryInterface;
use App\UI\Action\Interfaces\DeleteInfoActionInterface;
use App\UI\Responder\Interfaces\DeleteInfoResponderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(
 *     path="/deleteinfo/{id}",
 *     name="delete_info"
 * )
 */
// @Security("is_granted('ROLE_ADMIN')")
class DeleteInfoAction implements DeleteInfoActionInterface
{
    /**
     * @var InfosRepositoryInterface
     */
    private $infosRepository;

    /**
     * DeleteInfoAction constructor.
     *
     * @param InfosRepositoryInterface $infosRepository
     */
    public function __construct (InfosRepositoryInterface $infosRepository)
    {
        $this->infosRepository = $infosRepository;
    }

    /**
     * @param Request                      $request
     * @param DeleteInfoResponderInterface $responder
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     */
    public function __invoke(
        Request $request,
        DeleteInfoResponderInterface $responder
    ) {
        $this->infosRepository->deleteById($request->attributes->get('id'));

        return $responder();
    }
}
