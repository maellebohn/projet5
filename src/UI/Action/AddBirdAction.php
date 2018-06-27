<?php

declare(strict_types=1);

namespace App\UI\Action;

use App\UI\Action\Interfaces\AddBirdActionInterface;
use App\UI\Form\Handler\Interfaces\AddBirdTypeHandlerInterface;
use App\UI\Form\Type\AddBirdType;
use App\UI\Responder\Interfaces\AddBirdResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route(
 *     path="/addbird",
 *     name="add_bird"
 * )
 */
final class AddBirdAction implements AddBirdActionInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var AddBirdTypeHandlerInterface
     */
    private $addBirdTypeHandler;

    /**
     * AddNewsAction constructor.
     *
     * @param FormFactoryInterface        $formFactory
     * @param AddBirdTypeHandlerInterface $addBirdTypeHandler
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        AddBirdTypeHandlerInterface $addBirdTypeHandler
    ) {
        $this->formFactory = $formFactory;
        $this->addBirdTypeHandler = $addBirdTypeHandler;
    }

    /**
     * @param Request                   $request
     * @param AddBirdResponderInterface $responder
     *
     * @return mixed|\Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request, AddBirdResponderInterface $responder)
    {
        $addBirdType = $this->formFactory->create(AddBirdType::class)
                                         ->handleRequest($request);

        if($this->addBirdTypeHandler->handle($addBirdType)) {
            return $responder(true);
        }

        return $responder(false, $addBirdType);
    }
}
