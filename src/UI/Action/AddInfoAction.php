<?php

declare(strict_types=1);

namespace App\UI\Action;

use App\UI\Action\Interfaces\AddInfoActionInterface;
use App\UI\Form\Handler\Interfaces\AddInfoTypeHandlerInterface;
use App\UI\Form\Type\AddInfoType;
use App\UI\Responder\Interfaces\AddInfoResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route(
 *     path="/addinfo",
 *     name="add_info"
 * )
 */
final class AddInfoAction implements AddInfoActionInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var AddInfoTypeHandlerInterface
     */
    private $addInfoTypeHandler;

    /**
     * AddInfoAction constructor.
     *
     * @param FormFactoryInterface        $formFactory
     * @param AddInfoTypeHandlerInterface $addInfoTypeHandler
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        AddInfoTypeHandlerInterface $addInfoTypeHandler
    ) {
        $this->formFactory = $formFactory;
        $this->addInfoTypeHandler = $addInfoTypeHandler;
    }

    /**
     * @param Request                   $request
     * @param AddInfoResponderInterface $responder
     *
     * @return mixed|\Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(
        Request $request,
        AddInfoResponderInterface $responder
    ) {
        $addInfoType = $this->formFactory->create(AddInfoType::class)
                                         ->handleRequest($request);

        if($this->addInfoTypeHandler->handle($addInfoType)) {
            return $responder(true);
        }

        return $responder(false, $addInfoType);
    }
}
